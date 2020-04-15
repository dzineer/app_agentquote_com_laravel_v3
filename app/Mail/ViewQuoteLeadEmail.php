<?php

namespace App\Mail;

use App\Contracts\ViewQuotedLeadContract;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ViewQuoteLeadEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    /**
     * Create a new message instance.
     *
     * @param ViewQuotedLeadContract $quote
     */
    public function __construct(ViewQuotedLeadContract $quote)
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
        dd($data);
        $this->subject('Your Quote Lead');
        return $this->view('email.notifications.email_view_quote_lead', $data);
    }
}
