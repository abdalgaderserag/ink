<?php

namespace App\Observers;

use App\Comment;
use App\Notifications\NewComment;
use App\Observers\Extendable\NotificationHandle;
use App\Show;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class CommentObserver extends NotificationHandle
{
    /**
     * Handle the comment "created" event.
     *
     * @param  \App\Comment $comment
     * @return void
     */
    public function created(Comment $comment)
    {
        $userGrabber = $comment->ink;
        $type = 'comment';
        if (empty($userGrabber)) {
            $userGrabber = $comment->comment;
            $type = 'reply';
        }

        $user = $userGrabber->user;


        $show = Show::where('owner_id', Auth::id())->where('user_slug', $user->slug)->first();
        if (!empty($show)) {
            $show->score = $show->score + config('ink.rank.scores.' . $type);
            $show->save();
        }


        $user->notify(new NewComment($comment->id, $user->id));
    }

    /**
     * Handle the comment "updated" event.
     *
     * @param  \App\Comment $comment
     * @return void
     */
    public function updated(Comment $comment)
    {
        //
    }

    /**
     * Handle the comment "deleted" event.
     *
     * @param  \App\Comment $comment
     * @return void
     */
    public function deleted(Comment $comment)
    {


        $userGrabber = $comment->ink;
        if (empty($comment->ink)) {
            $userGrabber = $comment->comment;
        }

        $user = $userGrabber->user;

        $show = Show::where('owner_id', Auth::id())->where('user_slug', $user->slug)->first();
        if (!empty($show)) {
            $show->score = $show->score - config('ink.rank.scores.like');
            $show->save();
        }




        $comment->media()->delete();

        foreach ($comment->like as $like) {
            $like->delete();
        }

        foreach ($comment->replies as $reply) {
            $reply->delete();
        }
    }

}
