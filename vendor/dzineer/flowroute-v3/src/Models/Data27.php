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
class Data27 implements JsonSerializable
{
    /**
     * @todo Write general description for this property
     * @var \DZFlowroute\Models\Attributes28|null $attributes public property
     */
    public $attributes;

    /**
     * @todo Write general description for this property
     * @var string|null $id public property
     */
    public $id;

    /**
     * @todo Write general description for this property
     * @var \DZFlowroute\Models\Links|null $links public property
     */
    public $links;

    /**
     * @todo Write general description for this property
     * @var object|null $relationships public property
     */
    public $relationships;

    /**
     * @todo Write general description for this property
     * @var string|null $type public property
     */
    public $type;

    /**
     * Constructor to set initial or default values of member properties
     * @param Attributes28 $attributes    Initialization value for $this->attributes
     * @param string       $id            Initialization value for $this->id
     * @param Links        $links         Initialization value for $this->links
     * @param object       $relationships Initialization value for $this->relationships
     * @param string       $type          Initialization value for $this->type
     */
    public function __construct()
    {
        switch (func_num_args()) {
            case 5:
                $this->attributes    = func_get_arg(0);
                $this->id            = func_get_arg(1);
                $this->links         = func_get_arg(2);
                $this->relationships = func_get_arg(3);
                $this->type          = func_get_arg(4);
                break;

            default:
                $this->type = 'number';
                break;
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['attributes']    = $this->attributes;
        $json['id']            = $this->id;
        $json['links']         = $this->links;
        $json['relationships'] = $this->relationships;
        $json['type']          = $this->type;

        return $json;
    }
}
