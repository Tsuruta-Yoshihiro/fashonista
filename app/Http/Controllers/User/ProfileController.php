<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use App\Post;
use APP\User;


class ProfileController extends Controller
{
    public function add()
    {
        return view('user.profile.create');
    }
    
    public function create()
    {
        return redirect('user.profile.create');
    }
    
    //プロフィール画像登録
    public function index(Request $request)
    {
        $auth = Auth::user();
        $user = User::all();
        $param = [
            'auth'=>$auth,
            'users'=>$users
        ];
        return view('user.index',$param);
    }
    
    
    //プロフィール更新
    public function edit(Request $request)
    {
        //ユーザー情報の取得
        $auth = Auth::user();
        $param = [
            'auth'=>$auth,
        ];
        return view('user.profile.edit', $param);
    }
    
    
    public function update(Request $request)
    {
        //対象レコードの取得
        $user = User::find(Auth::user()->id);
        $user_form = $request->all();
        
        //誕生日更新
        unset($user_form['_token']);
        unset($user_form['birth_year']);
        unset($user_form['birth_month']);
        unset($user_form['birth_day']);
        $birthday = $request->birth_year . sprintf('%02d', $request->birth_month) . sprintf('%02d', $request->birth_day);
        $user_form->birthday = $birthday;
        
        
        //プロフィール画像変更
        $this->validate($request, [
            'file' => 'required|file|image|mimes:jpeg,png'
        ]);
        
        if(isset($uploadfile['thumbnail'])) {
        $thumbnailname = $request->file('thumbnail')->storeAs('public/thumbnail');
        $user->thumbnail = basename($thumbnailname);
        }
           
        $auth->fill($user_form)->save();
        return redirect('user/profile/mypages?id='. $request->user()->id);
    }
    
    
    public function mypages(Request $request)
    {
        //ログインユーザー情報の取得
        $auth = Auth::user();
        
        $posts = Post::where('user_id', $request->id)->get();
        return view('user.profile.mypages',[
            'posts' =>$posts, 
            'auth' =>$auth
         ]);
    }
    
    
    //いいね
    public function likes(string $name)
    {
        $user = User::where('name', $name)->first()
            ->load(['likes.user', 'likes.likes', 'likes.posts']);
        
        $posts = $user->likes->sortByDesc('create_at');
        
        return view('user.likes', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
    
    
    //フォロー
    public function followings(string $name)
    {
        $user = User::where('name', $name)->first()
            ->load('followings.followers');
        
        $followings = $user->followings->sortByDesc('create_at');
        
        return view('user.followings', [
            'user' => $user,
            'followings' => $followings
        ]);
    }
    
    
    //フォロワー
    public function followers(string $name)
    {
        $user = User::where('name',$name)->first()
            ->load('followers.followers');
            
        $followers = $user->followers->sortByDesc('create_at');
        
        return view('user.followers',[
            'user' => $user,
            'followers' => $followers
        ]);
    }
    
    public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();
        
        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }
        
        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);
        
        return ['name' => $name];
    }
    
    //フォローを外す
    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();
        
        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }
        
        $request->user()->followings()->detach($user);
        return ['name' => $name];
    }
    
    
    public function toppages()
    {
        return view('user.profile.toppages');
    }
    
    public function othermypages()
    {
        return view('user.profile.othermypages');
    }

}
