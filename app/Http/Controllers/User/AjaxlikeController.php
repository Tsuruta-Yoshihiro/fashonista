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
    public function like(Post $post) 
    {
        dd($post);
    }
       
}