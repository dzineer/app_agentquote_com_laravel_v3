<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class UserCreated
{
    use Dispatchable, SerializesModels;

    private $user;

    /**
     * Create a new event instance.
     *
     * @param $user
     */
    public function __construct($user
    )
    {
        $this->user = $user;
    }
}
