<?php

namespace App\Notifications;

use App\Broadcasting\FlowrouteChannel;
use App\Notifications\Messages\FlowrouteMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;

class FlowrouteNotification extends Notification
{
    use Queueable;
    private $to;
    private $from;
    private $content;

    /**
     * Create a new notification instance.
     *
     * @param $to
     * @param $from
     * @param $content
     */
    public function __construct($to, $from, $content)
    {
        $this->to = $to;
        $this->from = $from;
        $this->content = $content;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [FlowrouteChannel::class];
    }

    public function toSMS($notifiable)
    {
        return (new FlowrouteMessage)
            ->content( $this->content )
            ->from( $this->from )
            ->to( $this->to );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
