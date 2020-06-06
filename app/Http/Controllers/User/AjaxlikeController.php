<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use App\Post;

class AjaxlikeController extends Controller
{
    
   public function like(string $id)
    {
        $post = Post::where('id', $id)->with('likes')->first();
        if (! $post) {
            abort(404);
        }
        
        $post->likes()->detach(Auth::user()->id);
        $post->likes()->attach(Auth::user()->id);
        
        return ["post_id" => $id];
    }
    
    public function unlike(string $id)
    {
        $post = Post::where('id', $id)->with('likes')->first();
        if (! $post) {
            abort(404);
        }
        
        $post->likes()->detach(Auth::user()->id);
        
        return ["post_id" => $id];
    }
       
}