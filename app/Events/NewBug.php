<?php

namespace App\Events;

use App\Bug;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewBug extends Event
{
    use SerializesModels;

    public $bug;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Bug $bug)
    {
        $this->bug = $bug;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
