<?php

namespace SimpleSoftwareIO\SMS;

trait DoesNotReceive
{
    /**
     * Checks the server for messages and returns their results.
     *
     * @param array $options
     *
     * @return array
     */
    public function checkMessages(array $options = [])
    {
        \Illuminate\Support\Facades\Log::info( self::class . '::' . __METHOD__ . ' ' . json_encode($options) );
        throw new \RuntimeException('Receive methods are not support with the this driver.');
    }

    /**
     * Gets a single message by it's ID.
     *
     * @param string|int $messageId
     *
     * @throws \RuntimeException
     */
    public function getMessage($messageId)
    {
        \Illuminate\Support\Facades\Log::info( self::class . '::' . __METHOD__ . ' ' . json_encode($messageId) );
        throw new \RuntimeException('Receive methods are not support with the this driver.');
    }

    /**
     * Receives an incoming message via REST call.
     *
     * @param mixed $raw
     *
     * @throws \RuntimeException
     */
    public function receive($raw)
    {
        \Illuminate\Support\Facades\Log::info( self::class . '::' . __METHOD__ . ' ' . json_encode($raw) );
        throw new \RuntimeException('Receive methods are not support with the this driver.');
    }

    /**
     * Creates many IncomingMessage objects and sets all of the properties.
     *
     * @param string $rawMessage
     *
     * @return mixed
     */
    protected function processReceive($rawMessage)
    {
        \Illuminate\Support\Facades\Log::info( self::class . '::' . __METHOD__ . ' ' . json_encode($rawMessage) );
        throw new \RuntimeException('Receive methods are not support with this driver.');
    }
}
