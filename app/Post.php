<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Post extends Model
{
    protected $fillable = [
        'image_path',
        'coordination_summary',
        
    ];
    
    // user
    public function user(): BelongTo
    {
        return $this->BelongTo('App\User');
    }
    
    // いいね！
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
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
