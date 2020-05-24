<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
    //'user_id' => 'required',
    'image' => 'required',
    'coordination_summary' => 'required',
    );
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    //「いいね！」しているユーザーを抜き出す
    public function like_users()
    {
        return $this->belongsTomMany(User::class, 'likes', 'post_id', 'user_id')->withTimestamps();
    }
}
