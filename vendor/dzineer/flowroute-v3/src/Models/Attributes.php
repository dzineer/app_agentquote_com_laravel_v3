<?php
/*
 * DZFlowroute
 *
 * This file was automatically generated by APIMATIC v2.0 ( https://apimatic.io ).
 */

namespace DZFlowroute\Models;

use JsonSerializable;
use DZFlowroute\Utils\DateTimeHelper;

/**
 * @todo Write general description for this model
 */
class Attributes implements JsonSerializable
{
    /**
     * @todo Write general description for this property
     * @maps amount_display
     * @var double|null $amountDisplay public property
     */
    public $amountDisplay;

    /**
     * @todo Write general description for this property
     * @maps amount_nanodollars
     * @var double|null $amountNanodollars public property
     */
    public $amountNanodollars;

    /**
     * @todo Write general description for this property
     * @var string|null $body public property
     */
    public $body;

    /**
     * @todo Write general description for this property
     * @maps delivery_receipts
     * @var \DZFlowroute\Models\DeliveryReceipt[]|null $deliveryReceipts public property
     */
    public $deliveryReceipts;

    /**
     * @todo Write general description for this property
     * @var string|null $direction public property
     */
    public $direction;

    /**
     * @todo Write general description for this property
     * @var string|null $from public property
     */
    public $from;

    /**
     * @todo Write general description for this property
     * @maps is_mms
     * @var bool|null $isMms public property
     */
    public $isMms;

    /**
     * @todo Write general description for this property
     * @maps message_encoding
     * @var integer|null $messageEncoding public property
     */
    public $messageEncoding;

    /**
     * @todo Write general description for this property
     * @maps message_type
     * @var string|null $messageType public property
     */
    public $messageType;

    /**
     * @todo Write general description for this property
     * @var string|null $status public property
     */
    public $status;

    /**
     * @todo Write general description for this property
     * @factory \DZFlowroute\Utils\DateTimeHelper::fromRfc3339DateTime
     * @var \DateTime|null $timestamp public property
     */
    public $timestamp;

    /**
     * @todo Write general description for this property
     * @var string|null $to public property
     */
    public $to;

    /**
     * Constructor to set initial or default values of member properties
     * @param double    $amountDisplay     Initialization value for $this->amountDisplay
     * @param double    $amountNanodollars Initialization value for $this->amountNanodollars
     * @param string    $body              Initialization value for $this->body
     * @param array     $deliveryReceipts  Initialization value for $this->deliveryReceipts
     * @param string    $direction         Initialization value for $this->direction
     * @param string    $from              Initialization value for $this->from
     * @param bool      $isMms             Initialization value for $this->isMms
     * @param integer   $messageEncoding   Initialization value for $this->messageEncoding
     * @param string    $messageType       Initialization value for $this->messageType
     * @param string    $status            Initialization value for $this->status
     * @param \DateTime $timestamp         Initialization value for $this->timestamp
     * @param string    $to                Initialization value for $this->to
     */
    public function __construct()
    {
        if (12 == func_num_args()) {
            $this->amountDisplay     = func_get_arg(0);
            $this->amountNanodollars = func_get_arg(1);
            $this->body              = func_get_arg(2);
            $this->deliveryReceipts  = func_get_arg(3);
            $this->direction         = func_get_arg(4);
            $this->from              = func_get_arg(5);
            $this->isMms             = func_get_arg(6);
            $this->messageEncoding   = func_get_arg(7);
            $this->messageType       = func_get_arg(8);
            $this->status            = func_get_arg(9);
            $this->timestamp         = func_get_arg(10);
            $this->to                = func_get_arg(11);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['amount_display']     = $this->amountDisplay;
        $json['amount_nanodollars'] = $this->amountNanodollars;
        $json['body']               = $this->body;
        $json['delivery_receipts']  = $this->deliveryReceipts;
        $json['direction']          = $this->direction;
        $json['from']               = $this->from;
        $json['is_mms']             = $this->isMms;
        $json['message_encoding']   = $this->messageEncoding;
        $json['message_type']       = $this->messageType;
        $json['status']             = $this->status;
        $json['timestamp']          = isset($this->timestamp) ?
            DateTimeHelper::toRfc3339DateTime($this->timestamp) : null;
        $json['to']                 = $this->to;

        return $json;
    }
}
