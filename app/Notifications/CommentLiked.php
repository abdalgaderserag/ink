<?php

namespace App\Notifications;

use App\Media;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class CommentLiked extends Notification
{
    use Queueable;

    protected $user_name, $user_slug, $comment_text, $comment_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user_id, $comment_id)
    {
        $user = User::find($user_id);
        $this->user_slug = $user->slug;
        $this->user_name = $user->name;
        $media = Media::where('comment_id', $comment_id)->first();
        $this->comment_id = $comment_id;
        $this->ink_text = $media->text;
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
            'comment_id' => $this->comment_id,
            'comment' => $this->comment_text,
            'name' => $this->user_name,
            'slug' => $this->user_slug,
        ];
    }
}
