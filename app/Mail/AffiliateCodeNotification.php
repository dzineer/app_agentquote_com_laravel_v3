<?php

namespace App\Mail;

use App\Contracts\AffiliateContract;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AffiliateCodeNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \App\Contracts\PendingUserContract
     */
    private $data;

    /**
     * Create a new message instance.
     *
     * @param \App\Contracts\AffiliateContract $user
     */
    public function __construct(AffiliateContract $user)
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
        return $this->markdown('email.notifications.affiliate_code_notification.blade', compact('data'));
    }
}
