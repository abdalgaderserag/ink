<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    //
    protected $fillable = [
        'text', 'videos', 'images',
    ];

    public function ink()
    {
        return $this->belongsTo('App\Ink');
    }

    public function comment()
    {
        return $this->belongsTo('App\Comment');
    }
}
