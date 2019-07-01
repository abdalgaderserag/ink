<?php

namespace App\Listeners;

use App\Events\Like;
use App\Media;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class InkLiked
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct($ink_id,$user_id)
    {

    }

    /**
     * Handle the event.
     *
     * @param  Like  $event
     * @return void
     */
    public function handle(Like $event)
    {
        //
    }
}
