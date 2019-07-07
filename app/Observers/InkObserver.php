<?php

namespace App\Observers;

use App\Ink;

class InkObserver
{
    /**
     * Handle the ink "created" event.
     *
     * @param  \App\Ink  $ink
     * @return void
     */
    public function created(Ink $ink)
    {
        //
    }

    /**
     * Handle the ink "updated" event.
     *
     * @param  \App\Ink  $ink
     * @return void
     */
    public function updated(Ink $ink)
    {
        //
    }

    /**
     * Handle the ink "deleted" event.
     *
     * @param  \App\Ink  $ink
     * @return void
     */
    public function deleted(Ink $ink)
    {
        $ink->media()->delete();

        foreach ($ink->comment as $comment){
            $comment->delete();
        }

        foreach ($ink->like as $like){
            $like->delete();
        }
    }

}
