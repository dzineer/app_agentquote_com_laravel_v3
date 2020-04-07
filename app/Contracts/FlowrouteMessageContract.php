<?php


namespace App\Contracts;

use DZFlowroute\Models\Message as FlowrouteMessage;

/**
 * Class FlowrouteMessageContract
 * @package App\Contracts
 */
class FlowrouteMessageContract
{
    /**
     * @var
     */
    private $to;
    /**
     * @var
     */
    private $body;
    /**
     * @var
     */
    private $from_did;
    /**
     * @var null
     */
    private $callback_url;
    /**
     * @var
     */
    private $message;

    /**
     * FlowrouteMessageContract constructor.
     * @param $to
     * @param $body
     * @param $from_did
     * @param null $callback_url
     */
    public function __construct($to, $body, $from_did=null, $callback_url=NULL)
    {
        $this->to = $to;
        $this->body = $body;
        $this->from_did = $from_did;
        $this->callback_url = $callback_url;
    }

    public function setFromDID($id) {
        $this->from_did->id = $id;
    }

    /**
     * @return FlowrouteMessage
     */
    public function generate() {

        $this->message = new FlowrouteMessage();

        var_dump($this->from_did);

        // $this->message->from = $this->from_did->id;

        $this->message->to = $this->to; // Replace with your mobile number to receive messages from your Flowroute account

        $this->message->body = $this->body;

        if ($this->callback_url != NULL) {
            $this->message->dlr_callback = $this->callback_url;
        }

        return $this->message;

    }
}
