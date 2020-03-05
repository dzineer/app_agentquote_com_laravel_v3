<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class UserGroupChanged
{
    use Dispatchable, SerializesModels;

    private $group;

    private $user;

    /**
     * Create a new event instance.
     *
     * @param $user
     * @param $group
     */
    public function __construct($user, $group)
    {
        $this->group = $group;
        $this->user = $user;
    }
}
