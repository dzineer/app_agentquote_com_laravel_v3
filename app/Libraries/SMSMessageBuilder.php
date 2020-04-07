<?php


namespace App\Libraries;


use DZFlowroute\Models\Message as FlowrouteMessage;

class SMSMessageBuilder implements SMSMessageBuilderInterface
{
    /**
     * @var SMSMessageBuilderInterface
     */
    private $message;
    private $client;
    private $to;
    private $body;
    private $from_did;
    private $callback_url;
    private $messages;
    private $result;

    public function __construct($to, $body, $from_did, $callback_url = NULL)
    {
        $this->to = $to;
        $this->body = $body;
        $this->from_did = $from_did;
        $this->callback_url = $callback_url;

        $this->message = new FlowrouteMessage();

        var_dump($this->from_did);

        $this->message->from = $this->from_did->id;
        $this->message->to = $this->to; // Replace with your mobile number to receive messages from your Flowroute account
        $this->message->body = $this->body;

        if($this->callback_url != NULL)
        {
            $this->message->dlr_callback = $this->callback_url;
        }
    }

    public function send($client) {
        $this->client = $client;

        $this->messages = $this->client->getMessages();
        $this->result = $this->client->send($this->message);

        $this->messages = $this->client->getMessages();
        return $this->result = $this->messages->CreateSendAMessage($this->message);
    }
}
