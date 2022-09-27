<?php

namespace App\Events;

use App\PersonalDetail;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PersonalDetailGiven
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
    * The personaldetail instance.
    *
    * @var \App\PersonalDetail $personalDetail
    */
    public $personalDetail;

    /**
     * Create a new event instance.
     *
     * @param \App\PersonalDetail $personalDetail
     * @return void
     */
    public function __construct(PersonalDetail $personalDetail)
    {
        //
        $this->personalDetail = $personalDetail;
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
