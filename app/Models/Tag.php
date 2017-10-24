<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

	protected $table = 'tags';
	protected $fillable = ['id', 'name'];
    
    public function posts()
    {
        return $this->belongsToMany(\App\Models\Post::class);
    }

    # function to use the tag name as the identifier in route model binding instead of the id

    public function getRouteKeyName()
    {
    	# gimme the tag where the name column is same as what is passed
    	return 'name';
    }
}
