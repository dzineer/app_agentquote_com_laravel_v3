<?php

namespace App\Libraries\WHMCS;

class WHMCSApi {
    public static function action_request( $endpoint, $action, $user, $password, $format = 'json' ) {
        $params = array(
            'action' => $action,
            // See https://developers.whmcs.com/api/authentication
            'username' => $user,
            'password' => $password,
            'responsetype' => $format
        );

        $response = self::request( $endpoint, $params );

        return json_decode($response, true);

    }public static function action_request_with_params( $endpoint, $action, $user, $password, $params, $format = 'json' ) {
        $params2 = array_merge([
            'action' => $action,
            // See https://developers.whmcs.com/api/authentication
            'username' => $user,
            'password' => $password,
            'responsetype' => $format
        ], $params);

        echo "\nParams: " . print_r($params2,true) . "\n";

        $response = self::request( $endpoint, http_build_query($params2) );

        return json_decode($response, true);

    }

    public static function request( $endpoint, $params ) {
        $ch = curl_init();

        // echo print_r($params, true); exit;

        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            $params
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);

        // echo print_r($response, true);

        curl_close($ch);

        return $response;
    }
}
