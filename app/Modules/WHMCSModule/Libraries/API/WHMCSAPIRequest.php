<?php

namespace App\Modules\WHMCSModule\Libraries\API;

use App\Facades\AQLog;
use App\Modules\WHMCSModule\Contracts\WHMCRequestContract;

/**
 * Class WHMCSAPI
 *
 * @package App\Modules\WHMCSModule\Libraries\API
 */
class WHMCSAPIRequest {
    /**
     * @var false|resource
     */
    private $ch;

    /**
     * @var bool|string
     */
    private $response;
    private $data;
    /**
     * @var array
     */
    private $result;
    /**
     * @var \App\Modules\WHMCSModule\Contracts\WHMCRequestContract
     */
    private $requestContract;

    public function __construct()
    {

        $this->requestContract = (new WHMCRequestContract(
            config('whmcs.username'),
            config('whmcs.password'),
            config('whmcs.endpoint'),
            config('whmcs.scheme'),
            config('whmcs.host')
        ))->build();

        $this->ch = curl_init();
    }

    /**
     * @param $action
     * @param $fields
     */
    public function get($action, $fields) {
        return null;
    }

    /**
     * @param $action
     * @param $fields
     *
     * @return array
     */
    public function post($action, $fields) {

        AQLog::network( "URL: " . $this->requestContract['url']);

        $queryDetails = http_build_query(
            array_merge(
                $fields,
                ["action" => $action],
                $this->requestContract['credentials'],
                ["responsetype" => "json"]
            )
        );

        AQLog::network( "queryDetails: " . json_encode($queryDetails));

        curl_setopt($this->ch, CURLOPT_URL, $this->requestContract['url']);
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS,
            $queryDetails
        );
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, false);
        $this->response = curl_exec($this->ch);
        curl_close($this->ch);

        AQLog::network( "RESPONSE: " . json_encode($this->response));

        return $this->handleResponse();
    }

    /**
     * @return array
     */
    private function handleResponse() {
        $this->result = [
            "success" =>  true,
            "data" => []
        ];

        $this->data = json_decode( $this->response, JSON_OBJECT_AS_ARRAY );

        if ($this->data["result"] !== "success") {
            $this->result['success'] = false;
        } else {
            $this->result['data'] = $this->data;
        }

        return $this->result;
    }

}
