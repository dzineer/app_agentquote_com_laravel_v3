<?php


namespace App\Libraries;


/**
 * Interface SMSClientWrapperInterface
 * @package App\Libraries
 */
interface SMSClientWrapperInterface
{
    /**
     * SMSClientWrapperInterface constructor.
     * @param $client
     * @param $username
     * @param $password
     */
    public function __construct($client, $username, $password);

    /**
     * @return mixed
     */
    public function getMessages();

    /**
     * @param SMSMessageBuilderInterface $message
     * @param null $callback_url
     * @return mixed
     */
    public function send(SMSMessageBuilderInterface $message, $callback_url=null);
}
