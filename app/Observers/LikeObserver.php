<?php

namespace App\Observers;

use App\Like;
use App\Notifications\InkLiked;
use App\Observers\Extendable\NotificationHandle;
use App\Show;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LikeObserver extends NotificationHandle
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
        $show = Show::where('owner_id', Auth::id())->where('user_id', $user->id)->first();
        if (!empty($show)) {
            $show->score = $show->score + config('ink.rank.scores.like');
            $show->save();
        }
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
        $typed = 'ink_id';
        $id = $like->ink->id;

        if (empty($userGrabber)) {
            $userGrabber = $like->comment;
            $typed = 'comment_id';
            $id = $like->comment->id;
        }

        $show = Show::where('owner_id', Auth::id())->where('user_id', $userGrabber->user->id)->first();
        if (!empty($show)) {
            $show->score = $show->score - config('ink.rank.scores.like');
            $show->save();
        }

        $this->deleteNotification($userGrabber->user, 'InkLiked', $typed, $id);
    }
}
