<?php

namespace App\Observers;

use App\Notifications\Auth\AddProfileImages;
use App\Notifications\Auth\ImageChanged;
use App\User;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User $user
     * @return void
     */
    public function created(User $user)
    {
        $user->notify(new AddProfileImages());
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User $user
     * @param $path
     * @return void
     */
    public function updated(User $user,$path)
    {
        $user->notify(new ImageChanged($path));
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User $user
     * @return void
     */
    public function deleted(User $user)
    {
        foreach ($user->notifications as $notification) {
            $notification->delete();
        }

        foreach ($user->likes as $like) {
            $like->delete();
        }

        foreach ($user->inks as $ink) {
            foreach ($ink->media as $media) {
                $media->delete();
            }
            $ink->delete();
        }

        foreach ($user->comments as $comment) {
            $comment->delete();
        }
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
