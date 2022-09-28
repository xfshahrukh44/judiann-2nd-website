<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ViewerToggleBack
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $customer_id, $course_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($course_id, $customer_id)
    {
        $this->course_id = $course_id;
        $this->customer_id = $customer_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('viewer-toggle-back-'.$this->course_id);
    }
}
