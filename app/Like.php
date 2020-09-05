<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function user(): BelongTo
    {
        return $this->belongTo('App\User');
    }
    
    public function posts(): BelongTo
    {
        return $this->belongsTo('App\Post');
    }
    
    public function isLikedBy(?User $user): bool
    {
        return $user
        ?(bool)$this->likes->where('id', $user->id)->count()
        : false;
    }
    
    public function getlikesCountAttribute(): int
    {
        return $this->likes->count();
    }
}
