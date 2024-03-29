<?php

namespace Dzineer\SMS\Drivers;

use GuzzleHttp\Client;
use Dzineer\SMS\MakesRequests;
use Dzineer\SMS\DoesNotReceive;
use Dzineer\SMS\OutgoingMessage;

class MozeoSMS extends AbstractSMS implements DriverInterface
{
    use DoesNotReceive, MakesRequests;
    /**
     * The Guzzle HTTP Client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * The API's URL.
     *
     * @var string
     */
    protected $apiBase = 'https://www.mozeo.com/mozeo/customer/sendtxt.php';

    /**
     * Constructs the MozeoSMS Instance.
     *
     * @param Client $client The guzzle client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Sends a SMS message.
     *
     * @param \Dzineer\SMS\OutgoingMessage $message
     */
    public function send(OutgoingMessage $message)
    {
        $composeMessage = $message->composeMessage();

        foreach ($message->getTo() as $to) {
            $data = [
                'to'          => $to,
                'messagebody' => $composeMessage,
            ];

            $this->buildBody($data);

            $this->postRequest();
        }
    }
}
