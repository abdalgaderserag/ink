<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    protected $fillable=[
        'user_id','ink_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function ink()
    {
        $this->belongsTo('App\Ink');
    }

    public function comment()
    {
        $this->belongsTo('App\Comment');
    }
}
