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
    
    
}
