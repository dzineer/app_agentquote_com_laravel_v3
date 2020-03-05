<?php

namespace App\Events\Registration;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class UserRegistered
{
    use Dispatchable;

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
