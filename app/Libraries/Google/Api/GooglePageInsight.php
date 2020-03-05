<?php

namespace App\Libraries\Google\Api;

class GooglePageInsight {
    private $api;
    private $endpoint = 'https://www.googleapis.com/pagespeedonline/v5/runPagespeed';

    public function __construct() {
        $this->api = new GoogleAPI();
    }

    public function runPagespeed($apiKey, $url) {
        $this->api->setAPIKey($apiKey);
        $response = $this->api->request('GET', $this->endpoint, ["url" => $url]);

        // echo print_r($response, true); exit;

        if ( isset($response["error"]) ) {
            return [ "success" => false, "message" => $response['error']['errors'][0]['message'] ];
        } else {
            return [ "success" => true, "message" => $response ];
        }
    }
}
