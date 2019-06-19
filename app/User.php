<?php

namespace App;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'email', 'password', 'avatar', 'api_token'
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

//    public function notifications()
//    {
//        return $this->morphMany(DatabaseNotification::class, 'notifiable')->where('active', true)->orderBy('created_at', 'desc');
//    }

    public function follow()
    {
        return $this->hasMany('App\Follow');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

    public function ink()
    {
        return $this->hasMany('App\Ink');
    }

    public function share()
    {
        return $this->hasMany('App\Share');
    }

    public function followed()
    {
        return $this->hasOne('App\Follow', 'followed_slug');
    }

    public function follower()
    {
        return $this->hasMany('App\Follow', 'follower_id');
    }

}
