<?php


namespace App\Libraries;


abstract class SMSClientWrapper implements SMSClientWrapperInterface
{
    private $client;

    /**
     * SMSClientWrapper constructor.
     * @param $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function getMessages()
    {
        return $this->client->getMessages();
    }

    /**
     * @param $message
     * @return mixed
     */
    public function send($message)
    {
        $this->client->send($message);
    }

}
