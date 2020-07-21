<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    public function getAllUsers(Int $user_id)
    {
        return $this->Where('id', '<>', $user_id)->paginate(12);
    }
    
    // フォロー
    public function followings(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'follows', 'follower_id', 'followee_id')->withTimestamps();
    }
    
    // フォロワー
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'follows', 'followee_id', 'follower_id')->withTimestamps();
    }
    
    
    public function is_following($user_id)
    {
        return $this->followings()->where('followee_id', $user_id)->exists();
    }
    
    
    // フォローする
    public function follow($user_id)
    {
        // すでにフォロー済みではないか？
        $existing = $this->is_following($user_id);
        // フォローするIDが自身ではないか？
        $myself = $this->id == $user_id;
        
        // フォロー済みではないか、かつフォローIDが自身ではない場合、フォロー
        if (!$existing && !$myself) {
            $this->followings()->attach($user_id);
        }
    }
    
    //フォロー解除
    public function unfollow($user_id)
    {
        // すでにフォロー済みではないか？
        $existing = $this->is_following($user_id);
        // フォローするIDが自身ではないか？
        $myself = $this->id == $user_id;
        
        // すでにフォロー済みなら、フォローを外す
        if (!$existing && !$myself) {
            $this->followings()->detach($user_id);
        }
    }

    
    public function getFollowerCount($user_id)
    {
        return $this->where('follower_id', $user_id)->count();
    }

    public function getFolloweeCount($user_id)
    {
        return $this->where('followee_id', $user_id)->count();
    }
}
