<?php

namespace App\LocalServiceProviders\Flowroute;

use Illuminate\Http\Request;
use App\Flowroute\Exceptions\RequestIsNotAMessage;
use Illuminate\Support\Facades\Log;

/**
 * Class FlowrouteMessage
 * @package NotificationChannels\Flowroute
 */
class FlowrouteMessage
{
    private $debug = true;
    use \App\Libraries\Utilities\AQLogger;

    /**
     * The message content.
     *
     * @var string
     */
    public $content;

    /**
     * The phone number the message should be sent from.
     *
     * @var string
     */
    public $from;
    public $to;
    public $id;

    /**
     * Create a new message instance.
     *
     * @param  string $content
     *
     * @return static
     */
    public static function create($content = '')
    {
        return new static($content);
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @throws \NotificationChannels\Flowroute\Exceptions\RequestIsNotAMessage
     * @return $this
     */
    public function fromRequest(Request $request)
    {
        if (empty($request->data['type']) || $request->data['type'] !== 'message') {
            throw new RequestIsNotAMessage();
        }

        $data = $request->data['attributes'];
        $this->to = $data['to'];
        $this->from = $data['from'];
        $this->content($data['body']);

        return $this;
    }

    /**
     * Create a new message instance.
     *
     * @param  string $content
     */
    public function __construct($content = '')
    {
        $this->content = $content;
    }

    /**
     * Set the message content.
     *
     * @param  string $content
     *
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Set the phone number the message should be sent from.
     *
     * @param  string $from
     *
     * @return $this
     */
    public function from($from)
    {
        $this->from = $from;

        // use Illuminate\Support\Facades\Log;
        $this->AQLog( "\nFlowrouteMessage::from - from: " . $from . "" );


        return $this;
    }

    public function to($to)
    {
        $this->to = $to;

        // use Illuminate\Support\Facades\Log;
        $this->AQLog( "\nFlowrouteMessage::to - to: " . $to . "" );

        return $this;
    }

}
