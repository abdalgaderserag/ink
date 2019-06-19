<?php

namespace App\Traites;

use App\Ink;
use App\Notifications\InkLiked;
use Illuminate\Support\Facades\Auth;

trait LikeNotification
{
    protected function notifyInkLiked($ink_id)
    {
        $ink = Ink::find($ink_id);
        $user = $ink->user;
        if ($user->id != Auth::id())
            $user->notify(new InkLiked($ink_id, Auth::id()));
    }

    protected function notifyInkDisliked($ink_id)
    {
        $ink = Ink::find($ink_id);
        $user = $ink->user;
        foreach ($user->notifications as $note) {
            if ($note->data['user_id'] == Auth::id() && $note->data['ink_id'] == $ink_id) {
                $note->delete();
            }
        }

    }
}