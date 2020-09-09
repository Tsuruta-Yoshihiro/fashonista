<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Requests\PostRequest;
use App\Post;
use APP\User;
use Validator;
use App\Follow;
use App\Like;


class CoordinationController extends Controller
{
    public function add()
    {
        return view('user.coordination.create');
    }
    
    public function top(Request $request)
    {
        $posts = Post::all();
        $posts = Post::where('user_id', $request->id)->get();
        
        return view('/top', [
            'posts' => $posts
            ]);
    }
    
    public function create(Request $request)
    {
        $post = new Post;
        $form = $request->all();
        
        if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $post->image_path = basename($path);
        }
        
        unset($form['_token']);
        unset($form['image']);
        
        $post->fill($form);
        $post->user_id = $request->user()->id;
        $post->save();
        return redirect('user/profile/mypages?id='. $request->user()->id);
    }
    
     public function edit(Request $request)
    {
        $posts = Post::find($request->id);
        
        return view('user.coordination.edit', [
            'coordination_form' => $posts,
            'posts' => $posts
            ]);
    }
    
    public function update(Request $request)
    {
        // Validator チェック
        $rules = [
            'image_path' => 'required',
        ];
        //エラーメッセージ
        $messages = [
            'image_path.required' => 'ユーザー名が未入力です',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        
        if($validator->fails()){
            return redirect('/user/coordination/edit')
                ->withErrors($validator)
                ->withInput();
        }
        
        // Post Modelからデータ取得
        $posts = Post::find($request->id);
        $coordination_form = $request->all();
        if (isset($coordination_form['image'])) {
            $path = $request->file('image')->store('public/image');
            $posts->image_path = basename($path);
            unset($coordination_form['image']);
        } elseif (isset($request->remove)) {
            $posts->image_path = null;
            unset($coordination_form['remove']);
        }
        unset($coordination_form['_token']);
        $posts->fill($coordination_form)->save();
        
        return redirect('user/profile/mypages?id=');

    }
    
    public function delete(Request $request)
    {
        $posts = Post::find($request->id);
        $posts->delete();
        return redirect('user/profile/mypages?id=');
    }
    
    public function show(Request $request)
    {
        //ログインユーザー情報取得
        $auth = Auth::user();
        $select_user = User::where('id', $request->id)->first();
        //dd($select_user);
        
        // ログインユーザーが表示しようとしているユーザーをフォローしていれば、trueを返す
        $is_following = Follow::where('follower_id', $auth->id)->where('followee_id', $request->id)->exists();
        
        $post = Post::find($request->id);
        //post = Post::where('user_id', $request->id)->get();
        //dd($post);
        $post_user = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('users.name', 'users.thumbnail', 'users.id')
            ->where('user_id', $request->id)
            ->get();
        //dd($post_user);  
        return view('user.coordination.show', [
            'auth' => $auth,
            'user_info' => $select_user,
            'is_following' => $is_following,
            'post' => $post,
            'show_id' => $request->id,
            'post_user' => $post_user,
         ]);
    }
    
    //いいね！
    public function like(Request $request, Post $post)
    {
        $post->likes()->detach($request->user()->id);
        $post->likes()->attach($request->user()->id);
        
        return [
            'id' => $post->id,
            'likesCount' => $post->likes_count,
        ];
    }
    
    public function unlike(Request $request, Post $post)
    {
        $post->likes()->detach($request->user()->id);
        
        return [
            'id' => $post->id,
            'likesCount' => $post->likes_count,
        ];
    }


}
