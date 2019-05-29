<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    //
    public function user()
    {
        $this->belongsTo('App\User');
    }

    public function ink()
    {
        $this->belongsTo('App\Ink');
    }
}
