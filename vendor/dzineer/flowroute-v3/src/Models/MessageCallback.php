<?php
/*
 * DZFlowroute
 *
 * This file was automatically generated by APIMATIC v2.0 ( https://apimatic.io ).
 */

namespace DZFlowroute\Models;

use JsonSerializable;
/**
 * @This class encapsulates the properties of an SMS Callback URL
 */
class MessageCallback implements JsonSerializable
{
    /**
     * @The callback url requested
     * @var string $from public property
     */
    public $callback_url;

    /**
     * Constructor to set initial or default values of member properties
     * @param string $callback_url Initialization value for $this->callback_url
     */
    public function __construct()
    {
        if (1 == func_num_args()) {
            $this->callback_url = func_get_arg(0);
        }
    }

    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['callback_url'] = $this->callback_url;

        return $json;
    }
}
