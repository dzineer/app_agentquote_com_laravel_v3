<?php

namespace App\Mail;

use App\Contracts\PendingUserContract;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PendingManagerVerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    /**
     * Create a new message instance.
     *
     * @param \App\Contracts\PendingUserContract $pendingUser
     */
    public function __construct(PendingUserContract $pendingUser)
    {
        //
        $this->data = $pendingUser->toArray();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;
        return $this->markdown('email.confirmations.pending_manager_email_confirmation', compact('data'));
    }
}
