<?php

namespace App\Observers;

use App\Comment;
use App\Notifications\NewComment;

class CommentObserver
{
    /**
     * Handle the comment "created" event.
     *
     * @param  \App\Comment $comment
     * @return void
     */
    public function created(Comment $comment)
    {
        $userGrabber = $comment->ink();

        if (empty($userGrabber)) {
            $userGrabber = $comment->comment();
        }

        $user = $userGrabber->user();

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
        $comment->media()->delete();

        foreach ($comment->like() as $like) {
            $like->delete();
        }

        foreach ($comment->replies() as $reply) {
            $reply->delete();
        }
    }

}
