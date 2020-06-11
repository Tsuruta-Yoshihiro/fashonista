<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Follow extends Model
{
    //フォロー取得　フォロー時の取得でもこのメソットを使用
    public function following()
    {
         return $this->belongsToMany(User::class, 'follows', 'following_id', 'unfollow_id');
    }
    
    //フォロワー取得
    public function unfollow()
    {
         return $this->belongsToMany(User::class, 'follows', 'following_id', 'unfollow_id');
    }
}
