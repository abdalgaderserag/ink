<?php

namespace App\Notifications\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ImageChanged extends Notification
{
    use Queueable;

    protected $path;

    /**
     * Create a new notification instance.
     *
     * @param $path
     * @return void
     */
    public function __construct($path)
    {
        $this->path = $path;
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
            'text' => 'you have add new image do you want to make ink about it?',
            'path' => $this->path,
        ];
    }
}
