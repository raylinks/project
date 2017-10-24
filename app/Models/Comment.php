<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['id',  'post_id', 'user_id', 'full_name', 'email', 'body'];

    public function post()
    {
    	return $this->belongsTo(\App\Models\Post::class);
    }

    public function user()
    {
    	return $this->belongsTo(\App\User::class);
    }

    public function setBodyAttribute($value)
    {
        $this->attributes['body'] = strtoupper($value);
    }

    public function getBodyAttribute($value)
    {
        return strtolower($value);
    }
}
