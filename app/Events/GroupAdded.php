<?php

namespace App\Events;

use App\Models\Group;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\Models\Event as EventType;

class GroupAdded
{
    use Dispatchable, SerializesModels;

    private $group;
    private $event;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\Group $group
     * @param \App\Models\Event $event
     */
    public function __construct(Group $group, EventType $event)
    {
        $this->group = $group;
        $this->event = $event;
    }
}
