<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

class FollowController extends Controller
{
    // フォローの処理
    public function store($id)
    {
        \Auth::user()->follow($id);
        return back();
    }
    // フォローを外す処理
    public function destroy($id)
    {
        \Auth::user()->unfollow($id);
        return back();
    }
}
