<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\RegisterController;
use App\Post;
use APP\User;
use Validator;
use App\Follow;
use App\Like;


class ProfileController extends Controller
{
    public function add()
    {
        return view('user.profile.create');
    }
    
    public function create()
    {
        return redirect('user/profile/create');
    }
    
    public function mypages(Request $request)
    {
        //ログインユーザー情報取得
        $auth = Auth::user();
        $user = User::where('id', $request->id)->first();
        
        $posts = Post::where('user_id', $request->id)->latest('id')->get();
        
        // コーディネート投稿数をカウント
        $count_posts = Post::where('user_id', $request->id)->count();
        
        // ログインユーザーが表示しようとしているユーザーをフォローしていれば、trueを返す
        $is_following = Follow::where('follower_id', $auth->id)->where('followee_id', $request->id)->exists();
        // フォロー数をカウント
        $count_followings = Follow::where('follower_id', $request->id)->count();
        // フォロワー数をカウント
        $count_followers = Follow::where('followee_id', $request->id)->count();
        // いいね数をカウント
        $count_likes = Like::where('user_id', $request->id)->count();
        
        // 存在しないuser_idの場合はtrueを返す。
        // falseの場合はトップページへ自動で遷移（URLを手動で変更され、エラー画面を表示させないため）
        $doesnt_exists = User::where('id', $auth->id)->doesntExist();
        // 存在しているuser_idの場合はtrueを返す。
        $exists = User::where('id', $request->id)->exists();
        
        if($doesnt_exists !== $exists) {
        return view('user.profile.mypages', [
            'posts' => $posts, 
            'show_id' => $request->id,
            'user_info' => $user,
            'auth' => $auth,
            'is_following' => $is_following,
            'count_followings' => $count_followings,
            'count_followers' => $count_followers,
            'count_posts' => $count_posts,
            'count_likes' => $count_likes
         ]);
        }else{
         return redirect('top');
        }
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
        
        User::where('id',$request->user_id);
        return redirect('user/profile/mypages?id=' . $request->user()->id);
    }
    
    // フォロー中ユーザー表示
    public function followings(Request $request) 
    {
        //ログインユーザー情報の取得
        $auth = Auth::user();
        $select_user = User::where('id', $request->id)->first();
         
        // コーディネート投稿数をカウント
        $count_posts = Post::where('user_id', $request->id)->count();
        // ログインユーザーが表示しようとしているユーザーをフォローしていれば、trueを返す
        $is_following = Follow::where('follower_id', $auth->id)->where('followee_id', $request->id)->exists();
        
        // フォロー数をカウント
        $count_followings = Follow::where('follower_id', $request->id)->count();
        // フォロワー数をカウント
        $count_followers = Follow::where('followee_id', $request->id)->count();
        // いいね数をカウント
        $count_likes = Like::where('user_id', $request->id)->count();
        
        //followingsにはどういった情報が入っているか
        //画面で表示されているユーザーがフォローしているユーザー一覧
        $followings = Follow::where('follower_id', $request->id)->first();
        
        //followsテーブルのfollowee_idに登録されているユーザー（usersテーブルの情報）のname,thumbnail情報を取得する
        $users = DB::table('follows')
            ->join('users', 'follows.followee_id', '=', 'users.id')
            ->select('users.name', 'users.thumbnail', 'users.id')
            ->where('follower_id', $request->id)
            ->get();
        
        $cntFollowerPost= array();
        $cntFollowerFollowers= array();
        foreach($users as $user)
        {
            $cntFollowerPost[] = Post::where('user_id', $user->id)->count();
            $cntFollowerFollowers[] = Follow::where('followee_id', $user->id)->count();
        }
        //dd($cntFollowerPost); 
        // 存在しないuser_idの場合はtrueを返す。
        // falseの場合はトップページへ自動で遷移（URLを手動で変更され、エラー画面を表示させないため）
        $doesnt_exists = User::where('id', $auth->id)->doesntExist();
        // 存在しているuser_idの場合はtrueを返す。
        $exists = User::where('id', $request->id)->exists();
        
        if($doesnt_exists !== $exists) {
        return view('followings', [
            'show_id' => $request->id,
            'user_info' => $select_user,
            'auth' => $auth,
            'is_following' => $is_following,
            'count_followings' => $count_followings,
            'count_followers' => $count_followers,
            'count_posts' => $count_posts,
            'followings' => $followings,
            'users' => $users,
            'cntFollowerPost' => $cntFollowerPost,
            'cntFollowerFollowers' => $cntFollowerFollowers,
            'count_likes' => $count_likes
         ]);
        }else{
         return redirect('top');
        }
    }
    
    // フォロワーユーザー表示
    public function followers(Request $request)
    {
        //ログインユーザー情報の取得
        $auth = Auth::user();
        $select_user = User::where('id', $request->id)->first();
        
        // コーディネート投稿数をカウント
        $count_posts = Post::where('user_id', $request->id)->count();
        
        // ログインユーザーが表示しようとしているユーザーをフォローしていれば、trueを返す
        $is_following = Follow::where('follower_id', $auth->id)->where('followee_id', $request->id)->exists();
        
        // フォロー数をカウント
        $count_followings = Follow::where('follower_id', $request->id)->count();
        // フォロワー数をカウント
        $count_followers = Follow::where('followee_id', $request->id)->count();
        // いいね数をカウント
        $count_likes = Like::where('user_id', $request->id)->count();
        $followers = Follow::where('followee_id', $request->id)->exists();
        
        $users = DB::table('follows')
            ->join('users', 'follows.follower_id', '=', 'users.id')
            ->select('users.name', 'users.thumbnail', 'users.id')
            ->where('followee_id', $request->id)
            ->get();
            
        $cntFolloweePost= array();
        $cntFolloweeFollowees= array();
        foreach($users as $user)
        {
            $cntFolloweePost[] = Post::where('user_id', $user->id)->count();
            $cntFolloweeFollowees[] = Follow::where('follower_id', $user->id)->count();
        }
        
        // 存在しないuser_idの場合はtrueを返す。
        // falseの場合はトップページへ自動で遷移（URLを手動で変更され、エラー画面を表示させないため）
        $doesnt_exists = User::where('id', $auth->id)->doesntExist();
        // 存在しているuser_idの場合はtrueを返す。
        $exists = User::where('id', $request->id)->exists();
        
        if($doesnt_exists !== $exists) {
        return view('followers', [
            'show_id' => $request->id,
            'user_info' => $select_user,
            'auth' => $auth,
            'is_following' => $is_following,
            'count_followings' => $count_followings,
            'count_followers' => $count_followers,
            'count_posts' => $count_posts,
            'followers' => $followers,
            'users' => $users,
            'cntFolloweePost' => $cntFolloweePost,
            'cntFolloweeFollowees' => $cntFolloweeFollowees,
            'count_likes' => $count_likes
         ]);
        }else{
         return redirect('top');
        }
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
    public function likes(Request $request)
    {
        $auth = Auth::user();
        $user = User::where('id', $request->id)->first();
        // コーディネート投稿数をカウント
        $count_posts = Post::where('user_id', $request->id)->count();
        
        // ログインユーザーが表示しようとしているユーザーをフォローしていれば、trueを返す
        $is_following = Follow::where('follower_id', $auth->id)->where('followee_id', $request->id)->exists();
        
        // フォロー数をカウント
        $count_followings = Follow::where('follower_id', $request->id)->count();
        // フォロワー数をカウント
        $count_followers = Follow::where('followee_id', $request->id)->count();
        $followings = Follow::where('follower_id', $request->id)->get();
        
        // いいね数をカウント
        $count_likes = Like::where('user_id', $request->id)->count();
        
        $posts = Post::where('user_id', $request->id)->get();
        
        $likes = Post::select()
            ->join('likes', 'posts.id', '=', 'likes.post_id')
            ->select('posts.image_path', 'posts.coordination_summary', 'posts.id', 'posts.user_id')
            ->addSelect('post_id')
            ->where('likes.user_id', $request->id)
            ->groupBy('likes.id')
            ->get();    
        
        return view('likes', [
            'posts' => $likes,
            'show_id' => $request->id,
            'user_info' => $user,
            'auth' => $auth,
            'is_following' => $is_following,
            'count_followings' => $count_followings,
            'count_followers' => $count_followers,
            'count_posts' => $count_posts,
            'followings' => $followings,
            'count_likes' => $count_likes,
            'likes' => $likes
         ]);
    }
}
