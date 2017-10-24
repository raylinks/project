<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'full_name', 'email', 'password', 'phone_num', 'is_user', 'is_admin'];

    public function posts()
    {
        return $this->hasMany(\App\Models\Post::class);
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class);
    }


    public function likes()
    {
        return $this->hasMany(\App\Models\Like::class);
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
