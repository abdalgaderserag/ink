<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment_id',
    ];

    public function ink()
    {
        return $this->belongsTo('App\Ink');
    }

    public function comment()
    {
        return $this->belongsTo('App\Comment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function replies()
    {
        return $this->hasMany('App\Comment','comment_id');
    }

    public function like()
    {
        return $this->hasMany('App\Like');
    }

    public function media()
    {
        return $this->hasOne('App\Media');
    }
}
