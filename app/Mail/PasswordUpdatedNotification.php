<?php

namespace App\Mail;

use App\Contracts\UserContract;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordUpdatedNotification extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    /**
     * Create a new message instance.
     *
     * @param \App\Contracts\UserContract $user
     */
    public function __construct(UserContract $user)
    {
        //
        $this->data = $user->toArray();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;
        return $this->markdown('email.notifications.password_reset_email_notification', compact('data'));
    }
}
