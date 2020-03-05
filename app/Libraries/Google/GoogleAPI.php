<?php

namespace App\Libraries\Google\Api;

use App\Libraries\Api\ApiRequest;

/**
 * Class GoogleAPI
 *
 * @package App\Libraries\Google
 */
class GoogleAPI extends ApiRequest {
    /**
     * @var
     */
    protected $apiKey;

    /**
     * @param $apiKey
     */
    public function setAPIKey($apiKey) {
        $this->apiKey = $apiKey;
    }

    /**
     * @return mixed
     */
    public function getAPIKey() {
        return $this->apiKey;
    }

    /**
     * @param $type - get, post
     * @param $endpoint
     * @param $params
     *
     * @return bool|string
     */
    public function request( $type, $endpoint, $params ) {
        $type = strtoupper( $type );
        switch($type) {
            case 'GET':
                $newParams = array_merge(["key" => $this->getAPIKey()], $params);
                // echo print_r($newParams, true); exit;
                return parent::get( $endpoint, $newParams );

            case 'POST':
                $newEndpoint = $endpoint . '?key=' . $this->getAPIKey();
                return parent::post( $newEndpoint, $params );

            case 'JSON-POST':
                $newEndpoint = $endpoint . '?key=' . $this->getAPIKey();
                $newParams = json_encode($params);
                return parent::post( $newEndpoint, $newParams );

            default:
                return null;
        }
    }
}
