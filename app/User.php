<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender', 'height', 'birthday', 'thumbnail',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
    
    // 投稿
    public function posts(): HasMany
    {
        return $this->hasMany('App\Post');
    }
    
    // いいね！
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\Post', 'likes')->withTimestamps();
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
    
    
    public function is_following($userId)
    {
        return $this->followings()->where('followee_id', $userId)->exists();
    }
    
    
    // フォローする
    public function follow($userId)
    {
        // すでにフォロー済みではないか？
        $existing = $this->is_following($userId);
        // フォローするIDが自身ではないか？
        $myself = $this->id == $userId;
        
        // フォロー済みではないか、かつフォローIDが自身ではない場合、フォロー
        if (!$existing && !$myself) {
            $this->followings()->attach($userId);
        }
    }
    
    //フォロー解除
    public function unfollow($userId)
    {
        // すでにフォロー済みではないか？
        $existing = $this->is_following($userId);
        // フォローするIDが自身ではないか？
        $myself = $this->id == $userId;
        
        // すでにフォロー済みなら、フォローを外す
        if (!$existing && !$myself) {
            $this->followings()->detach($userId);
        }
    }
    
}

