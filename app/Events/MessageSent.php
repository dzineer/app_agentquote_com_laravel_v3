<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class MessageSent
{
    use Dispatchable, SerializesModels;

    private $user;
    private $mail;

    /**
     * Create a new event instance.
     *
     * @param $user
     * @param $mail
     */
    public function __construct($user, $mail)
    {
        $this->user = $user;
        $this->mail = $mail;
    }
}
