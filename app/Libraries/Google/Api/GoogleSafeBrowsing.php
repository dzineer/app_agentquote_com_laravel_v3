<?php

namespace App\Libraries\Google\Api;

class GoogleSafeBrowsing {
    private $api;
    private $endpoint = 'https://safebrowsing.googleapis.com/v4/threatMatches:find';

    public function __construct() {
        $this->api = new GoogleAPI();
    }

    public function runThreatLists($apiKey, $payload) {
        $this->api->setAPIKey($apiKey);
        $response = $this->api->request('JSON-POST', $this->endpoint, $payload);

        // echo "Response: " . print_r($response, true); exit;

/*        if ( isset($response["error"]) ) {
            return [ "success" => false, "message" => $response['error']['errors'][0]['message'] ];
        } else {
            return [ "success" => true, "message" => $response ];
        }*/
    }
}
