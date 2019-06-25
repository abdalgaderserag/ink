<?php

namespace App\Notifications;

use App\Media;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewComment extends Notification
{
    use Queueable;

    protected $user_name;
    protected $user_slug;
    protected $comment_text;
    protected $comment_id;

    /**
     * Create a new notification instance.
     *
     * @param $comment_id
     * @param $user_id
     * @return void
     */
    public function __construct($comment_id,$user_id)
    {
        $user = User::find($user_id);
        $this->user_slug = $user->slug;
        $this->user_name = $user->name;
        $media = Media::where('comment_id',$comment_id)->first();
        $this->comment_id = $comment_id;
        $this->comment_text = $media->text;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
