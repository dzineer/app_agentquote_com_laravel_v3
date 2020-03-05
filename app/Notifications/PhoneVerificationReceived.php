<?php

namespace App\Notifications;

use App\LocalServiceProviders\Flowroute\FlowrouteServiceProvider;
use App\Models\QuoteUnverified;
use App\Notifications\Messages\FlowrouteMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Flowroute\FlowrouteChannel;

class PhoneVerificationReceived extends Notification implements ShouldQueue
{
    private $debug = true;
    use \App\Libraries\Utilities\AQLogger;

    use Queueable;
    private $quoteUnverified;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\QuoteUnverified $quoteUnverified
     */
    public function __construct(QuoteUnverified $quoteUnverified)
    {
        $this->AQLog( "\n::__construct: quoteUnverified " . json_encode($quoteUnverified) . "" );

        $this->quoteUnverified = $quoteUnverified;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $this->AQLog( "\n::via: notifiable " . json_encode($notifiable) . "" );
        return [FlowrouteServiceProvider::class];
    }

    public function toFlowroute($notifiable)
    {
        $this->AQLog( "\n::toFlowroute: notifiable " . json_encode($notifiable) . "" );
        $this->AQLog( "\n::toFlowroute: quoteUnverified " . json_encode($this->quoteUnverified) . "" );
        return (new FlowrouteMessage)
            ->to($this->quoteUnverified->phone)
           // ->content('This is a test SMS via Flowroute using Laravel Notifications!');
            ->content($this->quoteUnverified->code);
    }
}
