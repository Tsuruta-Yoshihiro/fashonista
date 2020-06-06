<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'image_path',
        'coordination_summary',
        
    ];
    
    public function like ()
    {
        return $this->belongsToMany('App\User', 'like')->withTimestamps();
    }
    
}
