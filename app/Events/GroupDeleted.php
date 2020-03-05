<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class GroupDeleted
{
    use Dispatchable, SerializesModels;

    private $group;

    /**
     * Create a new event instance.
     *
     * @param $group
     */
    public function __construct($group)
    {
        $this->group = $group;
    }
}
