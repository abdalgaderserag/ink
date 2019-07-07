<?php

namespace App;

use App\Traites\UserRelation;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, UserRelation;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'background', 'details', 'email', 'password', 'avatar',
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

    public function show()
    {
        return $this->hasMany('App\Show','owner_id','id');
    }

    public function displayInks()
    {
        return $this->show()->with('inks');
    }

    public function ink()
    {
        $ink = $this->hasMany('App\Ink','user_slug','slug');
        return $ink->with('user','media','like');
    }

}
