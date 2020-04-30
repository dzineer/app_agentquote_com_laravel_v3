<?php

namespace Dzineer\SMS\Drivers;

use App\Facades\AQLog;
use GuzzleHttp\Client;
use Dzineer\SMS\MakesRequests;
use Dzineer\SMS\OutgoingMessage;


class FlowrouteSMS extends AbstractSMS implements DriverInterface
{
    use MakesRequests;

    const SUCCESSFUL = 202;

    /**
     * The Guzzle HTTP Client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;
    protected $responses;

    /**
     * The API's URL.
     *
     * @var string
     */
    protected $apiBase = 'https://api.flowroute.com/v2.1/messages';

    /**
     * Create the Flowroute instance.
     *
     * @param Client $client The Guzzle Client
     */
    public function __construct(Client $client, $accessKey, $secretKey)
    {
        $this->client = $client;
        $this->setUser($accessKey);
        $this->setPassword($secretKey);
    }

    /**
     * Sends a SMS message.
     *
     * @param \Dzineer\SMS\OutgoingMessage $message
     *
     * @return void
     */
    public function send(OutgoingMessage $message)
    {
        $from = $message->getFrom();
        $composeMessage = $message->composeMessage();

/*        $number = $message->getTo();

        $data = [
            'from'          => $from,
            'to'            => $number,
            'body'          => $composeMessage,
        ];

        $this->buildBody($data);
        // return first response
        return $this->postRequest();*/

        foreach ($message->getTo() as $number) {
            $data = [
                'from'          => $from,
                'to'            => $number,
                'body'          => $composeMessage,
            ];

            $this->buildBody($data);
            // return first response
            return $this->postRequest();
        }

    }

    /**
     * Checks the server for messages and returns their results.
     * See https://developer.flowroute.com/docs/lookup-a-set-of-messages.
     *
     * @param array $options
     *
     * @return array
     */
    public function checkMessages(array $options = [])
    {
        $this->buildBody($options);

        $rawMessages = json_decode($this->getRequest()->getBody()->getContents());

        return $this->makeMessages($rawMessages->data);
    }

    /**
     * Gets a single message by it's ID.
     *
     * @param string|int $messageId
     *
     * @return \Dzineer\SMS\IncomingMessage
     */
    public function getMessage($messageId)
    {
        $this->buildCall('/'.$messageId);

        return $this->makeMessage(json_decode($this->getRequest()->getBody()->getContents())->data);
    }

    /**
     * Receives an incoming message via REST call.
     *
     * @param mixed $raw
     *
     * @return \Dzineer\SMS\IncomingMessage
     */
    public function receive($raw)
    {
        $incomingMessage = $this->createIncomingMessage();
        $incomingMessage->setRaw($raw->get());
        $incomingMessage->setMessage($raw->get('body'));
        $incomingMessage->setFrom($raw->get('from'));
        $incomingMessage->setId($raw->get('id'));
        $incomingMessage->setTo($raw->get('to'));

        return $incomingMessage;
    }

    /**
     * Creates many IncomingMessage objects and sets all of the properties.
     *
     * @param $rawMessage
     *
     * @return mixed
     */
    protected function processReceive($rawMessage)
    {
        $incomingMessage = $this->createIncomingMessage();
        $incomingMessage->setRaw($rawMessage);
        $incomingMessage->setFrom((string) $rawMessage->attributes->from);
        $incomingMessage->setMessage((string) $rawMessage->attributes->body);
        $incomingMessage->setId((string) $rawMessage->id);
        $incomingMessage->setTo((string) $rawMessage->attributes->to);

        return $incomingMessage;
    }

    /**
     * Creates and sends a POST request to the requested URL.
     *
     * @return mixed
     */
    protected function postRequest()
    {

        $body = $this->getBody();

        // curl_setopt($ch, CURLOPT_USERPWD, "51314992:d0b1f7f6da117116f908fce5390f50ef");

        $payload = json_encode($body);

        AQLog::info(self::class . "::postRequest -  body : " . json_encode($body) );

        // \Illuminate\Support\Facades\Log::info( self::class . "::postRequest -  body : " . json_encode($body) );

        $ch = curl_init(
            $this->buildUrl()
        );

        curl_setopt($ch, CURLOPT_USERPWD, implode(":", $this->getAuth()) );

        //attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        //set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/vnd.api+json',
            'Accept: application/vnd.api+json'
        ));

        //return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //execute the POST request
        $response = curl_exec($ch);

/*        $response = $this->client->post($this->buildUrl(), [
            'Content-Type' => 'application/vnd.api+json',
            'Accept' => 'application/vnd.api+json',
            'auth' => $this->getAuth(),
            'json' => $payload,
        ]);*/

        // AQLog::info( self::class . "::postRequest -  response : " . print_r($response,true) );

        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        \Illuminate\Support\Facades\Log::info( self::class . "::postRequest -  status code : " . $statusCode );


        AQLog::info(self::class . "::postRequest -  response : " .
            print_r([
                "Status Code" => $statusCode,
                "url" => $this->buildUrl(),
                "payload" => $payload,
                "auth" => implode(":", $this->getAuth()),
                "header" => array(
                    'Content-Type: application/vnd.api+json',
                    'Accept: application/vnd.api+json'
                ),
                "response" => $response,
            ], true)
        );

        //close cURL resource
        curl_close($ch);

        if ($statusCode != self::SUCCESSFUL && $statusCode != 201 && $statusCode != 200) {
            $this->SMSNotSentException('Unable to request from API.');
           // return $response;
        }

        /*
        if ($response->getStatusCode() != 201 && $response->getStatusCode() != 200) {
            $this->SMSNotSentException('Unable to request from API.');
        }
        */

        $this->responses[] = $response;

        return $response;
    }
}
