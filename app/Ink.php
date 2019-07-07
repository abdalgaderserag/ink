<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ink extends Model
{
//    protected $fillable = [
//        'texts', 'images', 'videos',
//    ];

    public function like()
    {
        return $this->hasMany('App\Like');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_slug','slug');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

    public function media()
    {
        return $this->hasOne('App\Media');
    }

    public function getCreatedAtAttribute($key)
    {
        return $key;
    }
}
