<?php

namespace App\Observers;

use App\Follow;
use App\Show;
use Illuminate\Support\Facades\Auth;

class FollowObserver
{
    /**
     * Handle the follow "created" event.
     *
     * @param  \App\Follow  $follow
     * @return void
     */
    public function created(Follow $follow)
    {
        $show = new Show();
        $show->owner_id = Auth::id();
        $show->user_slug = $follow->follower->slug;
        $show->save();
    }

    /**
     * Handle the follow "updated" event.
     *
     * @param  \App\Follow  $follow
     * @return void
     */
    public function updated(Follow $follow)
    {
        //
    }

    /**
     * Handle the follow "deleted" event.
     *
     * @param  \App\Follow  $follow
     * @return void
     */
    public function deleted(Follow $follow)
    {
        $show = Show::where('owner_id',Auth::id())->where('user_slug',$follow->follower->slug)->first();
        $show->delete();
    }

}
