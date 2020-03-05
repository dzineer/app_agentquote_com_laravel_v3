<?php

namespace App\Mail;

use App\Models\MessageUser;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewQuoteReceivedMail extends Mailable
{
    use Queueable, SerializesModels;

    private $messageUser;

    /**
     * Create a new message instance.
     *
     * @param $messageUser
     */
    public function __construct(MessageUser $messageUser)
    {
        //
        $this->messageUser = $messageUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.generic', ["message" => $this->messageUser]);
    }
}
