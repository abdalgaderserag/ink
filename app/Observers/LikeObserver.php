<?php

namespace App\Observers;

use App\Like;
use App\Notifications\InkLiked;
use Illuminate\Support\Facades\Auth;

class LikeObserver
{
    /**
     * Handle the like "created" event.
     *
     * @param  \App\Like $like
     * @return void
     */
    public function created(Like $like)
    {
        $userGrabber = $like->ink;

        if (empty($userGrabber))
            $userGrabber = $like->comment;

        $user = $userGrabber->user;
        if ($user->id != Auth::id())
            $user->notify(new InkLiked($like->ink_id, Auth::id()));
    }


    /**
     * Handle the like "deleted" event.
     *
     * @param  \App\Like $like
     * @return void
     */
    public function deleted(Like $like)
    {
        $userGrabber = $like->ink;

        if (empty($userGrabber))
            $userGrabber = $like->comment;

        $user = $userGrabber->user;
        foreach ($user->notifications as $note) {
            if ($note->data['user_id'] == Auth::id() && $note->data['ink_id'] == $like->ink_id) {
                $note->delete();
            }
        }
    }
}
