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
class Error84 implements JsonSerializable
{
    /**
     * @todo Write general description for this property
     * @var \DZFlowroute\Models\Error1[]|null $errors public property
     */
    public $errors;

    /**
     * Constructor to set initial or default values of member properties
     * @param array $errors Initialization value for $this->errors
     */
    public function __construct()
    {
        if (1 == func_num_args()) {
            $this->errors = func_get_arg(0);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['errors'] = $this->errors;

        return $json;
    }
}
