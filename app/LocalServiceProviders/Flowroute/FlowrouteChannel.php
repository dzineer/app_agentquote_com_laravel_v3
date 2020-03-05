<?php

namespace App\LocalServiceProviders\Flowroute;

use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Str;
use App\Flowroute\Exceptions\CouldNotSendNotification;
use Illuminate\Notifications\Notification;

class FlowrouteChannel
{
    private $debug = true;
    use \App\Libraries\Utilities\AQLogger;

    /**
     * @var \NotificationChannels\Flowroute\Flowroute;
     */
    protected $flowroute;

    /**
     * The phone number notifications should be sent from.
     *
     * @var string
     */
    protected $from;

    /**
     * FlowrouteChannel constructor.
     *
     * @param \NotificationChannels\Flowroute\Flowroute $flowroute
     */
    public function __construct(Flowroute $flowroute)
    {
        $this->flowroute = $flowroute;
        $this->from = $this->flowroute->from();
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \App\Flowroute\Exceptions\CouldNotSendNotification
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send($notifiable, Notification $notification)
    {

        $this->AQLog( "::send - to: " .$notifiable->routeNotificationFor('flowroute') );

        if (!$to = $notifiable->routeNotificationFor('flowroute')) {
            return;
        }

        $message = $notification->toFlowroute($notifiable);

        $this->AQLog( "::send - message: " . $message );


        if (empty($message)) {
            return;
        } else if (env('SMS_FAKE')) {
            $response = new Response(200, [], json_encode([
                'data' => ['id' => Str::random(16)]]));
            return $response;
        } else if (is_string($message)) {
            $message = new FlowrouteMessage($message);
        }

        $response = $this->flowroute->sendSms([
            'from' => $message->from ?: $this->from,
            'to' => $to,
            'body' => trim($message->content),
            'dlr_callback' => $this->flowroute->webhook_url
        ]);

        $this->AQLog( "::send - message: " . json_decode($response) );

        if ($response->getStatusCode() !== 202) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($response);
        }

        return $response;
    }


}
