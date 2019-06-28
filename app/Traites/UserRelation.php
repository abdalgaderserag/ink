<?php

namespace App\Traites;

trait UserRelation
{
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