<?php

namespace Dzineer\SMS\Drivers;

use Dzineer\SMS\OutgoingMessage;

interface DriverInterface
{
    /**
     * Sends a SMS message.
     *
     * @param \Dzineer\SMS\OutgoingMessage $message
     */
    public function send(OutgoingMessage $message);

    /**
     * Checks the server for messages and returns their results.
     *
     * @param array $options
     *
     * @return array
     */
    public function checkMessages(array $options = []);

    /**
     * Gets a single message by it's ID.
     *
     * @param string|int $messageId
     *
     * @return \Dzineer\SMS\IncomingMessage
     */
    public function getMessage($messageId);

    /**
     * Receives an incoming message via REST call.
     *
     * @param mixed $raw
     *
     * @return \Dzineer\SMS\IncomingMessage
     */
    public function receive($raw);
}
