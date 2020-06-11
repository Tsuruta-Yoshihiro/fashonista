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
        'name', 'email', 'password', 'gender', 'height', 'birthday', 
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
    
    //投稿
    public function posts(): HasMany
    {
        return $this->hasMany('App\Post');
    }
    
    //いいね！
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\Post', 'likes')->withTimestamps();
    }
    
    //フォロー
    public function following(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'follows', 'following_id', 'unfollow_id')->withTimestamps();
    }
    
    //フォロワー
    public function unfollow(): BelongsToMany
    {
        return $this->belongsToMany('App\User','follows', 'unfollow_id', 'following_id')->withTimestamps();
    }
}

