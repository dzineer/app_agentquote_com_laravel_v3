<?php

namespace App\Events;

use App\Models\Event as EventType;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class LoginFailed
{
    use Dispatchable, SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     *
     * @param $user
     * @param \App\Models\Event $event
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
}
