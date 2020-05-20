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
    
    public function toppages()
    {
        return view('user.profile.toppages');
    }
    
    public function othermypages()
    {
        return view('user.profile.othermypages');
    }

}
