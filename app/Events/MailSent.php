<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class MailSent
{
    use Dispatchable, SerializesModels;

    private $user;
    private $message;

    /**
     * Create a new event instance.
     *
     * @param $user
     * @param $message
     */
    public function __construct($user, $message)
    {
        $this->user = $user;
        $this->message = $message;
    }
}
