<?php

namespace App\Events;

use App\Events\Event;
use App\BugComment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewBugComment extends Event
{
    use SerializesModels;

    public $comment; 

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(BugComment $comment)
    {
        $this->comment = $comment;
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
