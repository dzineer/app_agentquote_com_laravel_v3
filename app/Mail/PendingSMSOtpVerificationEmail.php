<?php

namespace App\Mail;

use App\Contracts\PendingQuoteContract;
use App\Contracts\PendingSMSCodeVerificationContract;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PendingSMSOtpVerificationEmail extends Mailable
{
    protected $debug = true;

    use Queueable, SerializesModels;
    use \App\Libraries\Utilities\AQLogger;

    /**
     * @var \App\Contracts\PendingSMSCodeVerificationContract
     */
    private $data;

    /**
     * Create a new message instance.
     *
     * @param \App\Contracts\PendingSMSCodeVerificationContract $pendingSMSCode
     */
    public function __construct(PendingSMSCodeVerificationContract $pendingSMSCode)
    {
        //
        $this->data = $pendingSMSCode->toArray();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;
        $this->AQLog( "::build - data: " . json_encode($data) . "" );
        $this->subject('Your 5-Digit Code for Quote Verification');
        return $this->view('email.confirmations.pending_email_sms_otp_code_confirmation', compact('data'));
    }
}
