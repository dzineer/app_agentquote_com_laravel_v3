<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\Models\Event as EventType;

class LoginAttempt
{
    use Dispatchable, SerializesModels;

    private $user;
    private $event;

    /**
     * Create a new event instance.
     *
     * @param $user
     * @param \App\Models\Event $event
     */
    public function __construct($user, EventType $event)
    {
        $this->user = $user;
        $this->event = $event;
    }
}
