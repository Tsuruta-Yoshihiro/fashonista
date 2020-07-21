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
use Validator;
use App\Follow;

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
    
    
    //プロフィール編集
    public function edit(Request $request)
    {
        //ユーザー情報の取得
        $auth = Auth::user();
        $param = [
            'auth'=>$auth,
        ];
        return view('user.profile.edit', $param);
    }
    
    //プロフィール更新
    public function update(Request $request)
    {
        // Validator チェック
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'thumbnail' => 'file|image|mimes:jpeg,png,jpg'
        ];
        
        //エラーメッセージ
        $messages = [
            'name.required' => 'ユーザー名が未入力です',
            'email.required' => 'メールアドレスが未入力です',
        ];
        
        $validator = Validator::make($request->all(),$rules,$messages);
        
        if($validator->fails()){
            return redirect('/user/profile/edit')
                ->withErrors($validator)
                ->withInput();
        }
        
        //対象レコードの取得
        $user = User::find(Auth::user()->id);
        $user_form = $request->all();
        unset($user_form['_token']);
        unset($user_form['thumbnail']);
        //プロフィール画像登録＆更新
        $file = $request->file('thumbnail');
        
          if(!empty($file)) {
            $thumbnail = $request->file('thumbnail')->store('public/thumbnail');
            $user->thumbnail = basename($thumbnail);
            $param = [
                'name'=>$request->name,
                'thumbnail'=>$thumbnail
            ];
        }
        // レコードアップデート
        $user->fill($user_form)->save();
        
        User::where('id',$request->user_id)->update($param);
        return redirect('user/profile/mypages?id='. $request->user()->id);
    }
    
    public function mypages(Request $request)
    {
        //ログインユーザー情報の取得
        $auth = Auth::user();
        $user = User::where('id', $request->id)->first();
        
        // ログインユーザーが表示しようとしているユーザーをフォローしていれば、trueを返す
        $is_following = Follow::where('followee_id', $auth->id)->where('follower_id', $request->id)->exists();
        
        $posts = Post::where('user_id', $request->id)->get();
        return view('user.profile.mypages', [
            'posts' => $posts, 
            'show_id' => $request->id,
            'user_info' => $user,
            'auth' => $auth,
            'is_following' => $is_following
         ]);
    }
    
    // フォロー中ユーザー表示
    public function followings($id)
    {
        $user = User::find(Auth::user()->id);
        $followings = $user->followings()->paginate(12);
        $date = [
            'user' =>$user,
            'users' => $followings
        ];
        $this->counts($user);
        return view('user.profile.mypages', [
            'count_followings' => $count_followings,
            ]);
    }
    
    // フォロワーユーザー表示
    public function followers($id)
    {
        $user = User::find(Auth::user()->id);
        $followers = $user->followers()->paginate(12);
        $date = [
            'user' =>$user,
            'users' => $followers
        ];
        $this->counts($user);
        return view('user.profile.mypages', [
            'count_followers' => $count_followers,
            ]);
    }
    
    public function index(User $user)
    {
        $all_users = $user->getAllUsers(auth()->user()->id);

        return view('user.profile.index', [
            'all_users'  => $all_users
        ]);
    }
    
    // フォローする
    public function follow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->is_following($user->id);
        if(!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($user->id);
            return back();
        }
    }
    
    //フォロー解除
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->is_following($user->id);
        if($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($user->id);
            return back();
        }
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
    
    public function top()
    {
        return view('user.profile.top');
    }
}
