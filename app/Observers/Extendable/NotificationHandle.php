<?php

namespace App\Observers\Extendable;

use App\User;

class NotificationHandle
{
    /**
     * Handle the deleted notifications event.
     *
     * @param User $user
     * @param $type
     * @param $typed
     * @param $id
     * @return void
     */
    public function deleteNotification(User $user, $type, $typed, $id)
    {
        $type = 'App\Notifications\\' . $type;
        foreach ($user->notifications as $note) {
            if ($note->type === $type &&
                $note->notifiable_id === $user->id &&
                $note->data['' . $typed] === $id) {


                $note->delete();
            }
        }
    }
}
