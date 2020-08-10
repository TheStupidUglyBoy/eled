<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


//use Illuminate\Broadcasting\InteractsWithSockets;
//use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PusherCommentApprovedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $message ; 
    public $slug ; 
    public $comment_id ; 

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message,$slug,$comment_id)
    {
        $this->message = $message ;
        $this->slug      = $slug ;
        $this->comment_id = $comment_id ;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //return new PrivateChannel('channel-name');
        return ['eled'];
    }


    public function broadcastAs()
    {
      return 'PusherCommentApprovedEvent';
    }
}
