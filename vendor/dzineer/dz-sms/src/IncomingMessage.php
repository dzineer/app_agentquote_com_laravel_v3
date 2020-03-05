<?php

namespace Dzineer\SMS;

class IncomingMessage
{
    /**
     * Holds the raw data from a provider.
     *
     * @var mixed
     */
    protected $raw;

    /**
     * Holds the message ID.
     *
     * @var string
     */
    protected $id;

    /**
     * Holds who a message came from.
     *
     * @var string
     */
    protected $from;

    /**
     * Holds the to address.
     *
     * @var string
     */
    protected $to;

    /**
     * Holds the message body.
     *
     * @var string
     */
    protected $message;

    /**
     * Returns the raw data.
     *
     * @return mixed
     */
    public function raw()
    {
        return $this->raw;
    }

    /**
     * Sets the raw data.
     *
     * @param mixed $raw
     */
    public function setRaw($raw)
    {
        $this->raw = $raw;
    }

    /**
     * Returns the message id.
     *
     * @return string
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Sets the message id.
     *
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Returns the from address.
     *
     * @return string
     */
    public function from()
    {
        return $this->from;
    }

    /**
     * Sets the from address.
     *
     * @param string $from
     */
    public function setFrom($from)
    {
        \Illuminate\Support\Facades\Log::info( self::class . '::' . __METHOD__ . ' ' . json_encode($from) );
        $this->from = $from;
    }

    /**
     * Returns the to address.
     *
     * @return string
     */
    public function to()
    {
        return $this->to;
    }

    /**
     * Sets the to address.
     *
     * @param string $to
     */
    public function setTo($to)
    {
        \Illuminate\Support\Facades\Log::info( self::class . '::' . __METHOD__ . ' ' . json_encode($to) );
        $this->to = $to;
    }

    /**
     * Returns the message body.
     *
     * @return string
     */
    public function message()
    {
        \Illuminate\Support\Facades\Log::info( self::class . '::' . __METHOD__ . ' ' . json_encode($this->message) );
        return $this->message;
    }

    /**
     * Sets the message body.
     *
     * @param string $message
     */
    public function setMessage($message)
    {
        \Illuminate\Support\Facades\Log::info( self::class . '::' . __METHOD__ . ' ' . json_encode($message) );
        $this->message = $message;
    }
}
