<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

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
    
    public function edit()
    {
        return view('user.profile.edit');
    }
    
    public function update()
    {
        return redirect('user.profile.edit');
    }
    
    
    public function mypages(Request $request)
    {
        $posts = Post::where('user_id', $request->id)->get();
        return view('user.profile.mypages',["posts" =>$posts]);
    }
    
    
    //いいね
    public function likes(string $name)
    {
        $user = User::where('name', $name)->first()
            ->load(['likes.user', 'likes.likes', 'likes.posts']);
        
        $posts = $user->likes->sortByDesc('create_at');
        
        return view('user.likes', [
            'user' => $user,
            'posts' => $posts,
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
            'followings' => $followings,
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
            'followers' => $followers,
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
