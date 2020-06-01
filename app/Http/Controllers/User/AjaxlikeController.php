<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\Like;
use Auth;
use App\Post;

class AjaxlikeController extends Controller
{
    public function like(Post $posts) 
    {
        \Auth::user()->id;
        $like = Like::create(['user_id' => \Auth::user()->id, 'post_id' => $post->id]);
        
        return response()->json([]);
    }
       
}