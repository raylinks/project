<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $table = 'posts';
	protected $fillable = ['id', 'user_id', 'title', 'content', 'image'];
   
    public function user()
    {
    	return $this->belongsTo(\App\User::class);
    }


    public function tags()
    {
        return $this->belongsToMany(\App\Models\Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(\App\Models\Like::class);
    }
    
    # dedicated method
    
    public static function archives()
    {
        return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
        ->groupBy('year', 'month')
        ->orderByRaw('min(created_at) desc')
        ->get()
        ->toArray();
    }

  /*  public function addComment($body)
    {
        #$this->comments()->create(['body' => $body]);
        $this->comments()->create(compact('body'));
    }
*/
    public function setTitleAttribute($value)
    {
		$this->attributes['title'] = strtolower($value);
    }

    public function getTitleAttribute($value)
    {
    	return strtoupper($value);
    }

}
