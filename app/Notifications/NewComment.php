<?php

namespace App\Notifications;

use App\Media;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class NewComment extends Notification
{
    use Queueable;

    private $user_name, $user_slug, $init_text, $init_id;

    /**
     * Create a new notification instance.
     *
     * @param $init_id
     * @param $user_id
     * @return void
     */
    public function __construct($init_id, $user_id)
    {
        $user = User::find($user_id);
        $this->user_slug = $user->slug;
        $this->user_name = $user->name;
        /*$media = Media::where('comment_id', $init_id)->first();
        if (empty($media)) {
            $media = Media::where('ink_id', $init_id)->first();
            $this->init_id = $init_id;
            $this->init_text = $media->text;
        } else {
            $this->init_id = $init_id;
            $this->init_text = $media->text;
        }*/
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'user_id' => Auth::id(),
//            'comment_id' => $this->init_id,
//            'ink' => $this->init_text,
            'name' => $this->user_name,
            'slug' => $this->user_slug,
        ];
    }
}
