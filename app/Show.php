<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    public function owner()
    {
        return $this->belongsTo('App\User','owner_id','id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
