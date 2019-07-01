<?php

namespace App\Events;

use App\Media;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Like
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $user_name,$user_slug,$text,$ident;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($media,$user_id)
    {
        $user = User::find($user_id);
        $this->user_slug = $user->slug;
        $this->user_name = $user->name;
        $media = Media::where('ink_id',$media)->first();
        $this->ident = $media;
        $this->text = $media->text;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
