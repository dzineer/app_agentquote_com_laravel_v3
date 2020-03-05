<?php

namespace App\Libraries\WordPress\Api;

use App\Libraries\Api\BaseCurlRequest;

/**
 * Class WordPressAPI
 *
 * @package App\Libraries\Google
 */
class WordPressAPI extends BaseCurlRequest {
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
                return parent::get( $endpoint, $params );

            case 'POST':
                return parent::post( $endpoint, $params );

            default:
                return null;
        }
    }
}
