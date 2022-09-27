<?php

namespace App\Events;

use App\Models\HouseholdCondition;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class HouseProvided
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
    * a HouseholdCondition instance.
    *
    * @var \App\Models\PersonalDetails $household
    */
    public $household;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(HouseholdCondition $household)
    {
        $this->household = $household;
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
