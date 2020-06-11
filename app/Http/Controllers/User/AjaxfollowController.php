<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;


class AjaxfollowController extends Controller

{
    public function following(Request $request)
    {
        return view('user.profile.othermypages');
    }
    
    public function unfollow(Request $request)
    {
         return view('user.profile.othermypages');
    }
}
