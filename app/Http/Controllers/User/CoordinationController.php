<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post;
use APP\User;

class CoordinationController extends Controller
{
    public function add()
    {
        return view('user.coordination.create');
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




    public function edit()
    {
        return view('user.coordination.edit');
    }
    
    public function update()
    {
        return redirect('user.coordination.edit');
    }
    

}
