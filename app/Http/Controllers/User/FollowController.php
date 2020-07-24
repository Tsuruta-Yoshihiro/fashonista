<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Follow;
use App\User;

class FollowController extends Controller
{
    // フォローの処理
    public function store(Request $request)
    {
        
        \Auth::user()->follow($request->id);
        return back();
    }
    // フォローを外す処理
    public function destroy(Request $request)
    {
        
        \Auth::user()->unfollow($request->id);
        return back();
    }
}
