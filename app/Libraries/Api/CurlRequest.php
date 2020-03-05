<?php

namespace App\Libraries\Api;

class CurlRequest {

    private $ch;
    private $response;

    public function __construct()
    {
        $this->ch = curl_init();
    }

    public function post_request( $endpoint, $params ) {
        echo "\nEndpoint: " . $endpoint . "\n";
        echo "\nparams: " . print_r($params,true) . "\n";
        // exit;
        curl_setopt($this->ch, CURLOPT_URL, $endpoint);
       // curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $params );
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Connection: Keep-Alive'
            ));
        $this->response = curl_exec($this->ch);
        echo "\nresponse: " . print_r($this->response,true) . "\n";
        curl_close($this->ch);
        return json_decode( $this->response, true);
    }

    public function post( $endpoint, $params ) {
        return $this->post_request( $endpoint, $params );
    }

    public function get_request( $endpoint ) {
        echo "\nEndpoint: " . $endpoint . "\n";
        curl_setopt($this->ch, CURLOPT_URL, $endpoint);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        $this->response = curl_exec($this->ch);
       // echo print_r($this->response,true); exit;
        curl_close($this->ch);
        return json_decode( $this->response, true);
    }

    public function get( $endpoint, $params ) {
        $query = http_build_query($params);
        return $this->get_request( $endpoint . '?' . $query );
    }

}
