<?php
/*
 * DZFlowroute
 *
 * This file was automatically generated by APIMATIC v2.0 ( https://apimatic.io ).
 */

namespace DZFlowroute\Models;

use JsonSerializable;

/**
 * @todo Write general description for this model
 */
class Links implements JsonSerializable
{
    /**
     * @todo Write general description for this property
     * @var string|null $self public property
     */
    public $self;

    /**
     * Constructor to set initial or default values of member properties
     * @param string $self Initialization value for $this->self
     */
    public function __construct()
    {
        if (1 == func_num_args()) {
            $this->self = func_get_arg(0);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['self'] = $this->self;

        return $json;
    }
}
