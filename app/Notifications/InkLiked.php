<?php

namespace App\Notifications;

use App\Ink;
use App\Media;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class InkLiked extends Notification
{
    use Queueable;

    protected $user_name;
    protected $user_slug;
    protected $ink_text;
    protected $ink_id;

    /**
     * Create a new notification instance.
     *
     * @param Ink $ink
     * @param User $user
     * @return void
     */
    public function __construct($ink_id,$user_id)
    {
        $user = User::find($user_id);
        $this->user_slug = $user->slug;
        $this->user_name = $user->name;
        $media = Media::where('ink_id',$ink_id)->first();
        $this->ink_id = $ink_id;
        $this->ink_text = $media->text;
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
            'user_id' => Auth::id(),
            'ink_id' => $this->ink_id,
            'ink' => $this->ink_text,
            'name' => $this->user_name,
            'slug' => $this->user_slug,
        ];
    }
}
