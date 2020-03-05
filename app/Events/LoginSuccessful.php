<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\Models\EventType;

class LoginSuccessful
{
    use Dispatchable, SerializesModels;

    private $user;
    private $event;

    /**
     * Create a new event instance.
     *
     * @param $user
     * @param \App\Models\EventType $event
     */
    public function __construct($user, EventType $event)
    {
        $this->user = $user;
        $this->event = $event;
    }
}
