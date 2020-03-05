<?php

namespace App\Mail;

use App\Contracts\ViewQuoteContract;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ViewQuoteEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \App\Contracts\PendingQuoteContract
     */
    private $data;

    /**
     * Create a new message instance.
     *
     * @param \App\Contracts\ViewQuoteContract $quote
     */
    public function __construct(ViewQuoteContract $quote)
    {
        //
        $this->data = $quote->toArray();
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
        $this->subject('Your Quote Request');
        return $this->view('email.notifications.email_view_quote', compact('data'));
    }
}
