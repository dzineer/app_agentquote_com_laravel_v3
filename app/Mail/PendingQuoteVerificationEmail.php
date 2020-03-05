<?php

namespace App\Mail;

use App\Contracts\PendingQuoteContract;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PendingQuoteVerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \App\Contracts\PendingQuoteContract
     */
    private $data;

    /**
     * Create a new message instance.
     *
     * @param \App\Contracts\PendingQuoteContract $pendingQuote
     */
    public function __construct(PendingQuoteContract $pendingQuote)
    {
        //
        $this->data = $pendingQuote->toArray();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;
        // dd($data);
        return $this->view('email.confirmations.pending_email_quote_confirmation', compact('data'));
    }
}
