<?php

namespace App\Quoters;

class AquoterGateway {

    private $access_token;
    private $access_token_set;
    private $hostname;
    private $endpoint;

    function __construct() {
        $this->access_token = '';
        $this->access_token_set = false;
    }

    function setAccessToken( $access_token ) {
        $this->access_token = $access_token;
        $this->access_token_set = true;
    }

    function setHostname( $hostname ) {
        $this->hostname = $hostname;
    }

    function setEndpoint( $endpoint ) {
        $this->endpoint = $endpoint;
    }

    function getQuote( $data ) {

        if ( ! $this->access_token_set )
            return null;

            $get_data 	=  $data;
            $get_data['access_token'] = $this->access_token;

       /*
        $get_data 	= 	array(
            'access_token' =>   $this->access_token,
            'id'           =>   $data['id'],
            'state'        => 	$data['state'],
            'month'        => 	$data['month'],
            'day'          => 	$data['day'],
            'year'         => 	$data['year'],
            'gender'       => 	$data['gender'],
            'term'         => 	$data['term'],
            'tobacco'      => 	$data['tobacco'],
            'benefit'      => 	$data['benefit'],
            'period'       => 	$data['period'] );
        */

        $this->setHostname( 'http://149.28.45.153' );
        $this->setEndpoint( '/v1/quotes?' );

        // echo "<br>get_data: " . print_r($get_data,true) . '<br>';

        // echo "<br>" . 'https://api.aq2e.com/v1/quotes?access_token=7c25c7552fb3015a64df141b87d4c3d9047b81ce&id=3&term=10&state=CA&period=0&month=9&day=4&year=1974&gender=m&tobacco=n&benefit=100';
        //             https://api.aq2e.com/v1/quotes?access_token=7c25c7552fb3015a64df141b87d4c3d9047b81ce&id=3&state=CA&month=9&day=4&year=1974&gender=m&term=10&tobacco=n&period=0

        return $this->getRequest( $get_data );
    }

	function getAccessToken( $account ) {

        $post_data 		= 	array(
            'client_id'     => 	$account->client_id,
            'client_secret' => 	$account->client_secret,
            'grant_type'    => 	$account->grant_type,
        );

        /*
        $post_data 		= 	array(
            'client_id'     => 	'fdecker',
            'client_secret' => 	'fdecker',
            'grant_type'    => 	'client_credentials',

        );
        */

        $resultData = $this->postRequest( $post_data );

        // echo '<pre>resultData: <br>' . print_r( $resultData,true) . '<br>';

        return json_decode( $resultData, true );

    }

    private function getRequest( $data ) {

        $get_string 	 = 	http_build_query($data);

        $urlRequest = $this->hostname . $this->endpoint . $get_string;

//        echo "<br>URL: " . $urlRequest . '<br>';

        $curl_connection = 	curl_init($urlRequest);

        curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);

        curl_setopt($curl_connection, CURLOPT_USERAGENT, "AQ2E REST API Client");

        curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($curl_connection, CURLOPT_POST, 0);

        curl_setopt($curl_connection, CURLOPT_HTTPGET, 1);

        curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);

        curl_setopt($curl_connection, CURLOPT_URL, $urlRequest);

        $result = curl_exec($curl_connection);// perform our request

        curl_close($curl_connection);// close the connection

        return $result;

    }

    private function postRequest( $data ) {

        $urlRequest = $this->hostname . $this->endpoint;

        // echo "<br>URL: " . $urlRequest . '<br>';

        $post_string 	 = 	http_build_query($data);
        // echo "<br>post_string: " . print_r($post_string,true) . '<br>';
        $curl_connection = 	curl_init($urlRequest);

        curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);

        curl_setopt($curl_connection, CURLOPT_USERAGENT, "AQ2E OAUTH2 API");

        curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);

        curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string);// set data to be posted

        $result = curl_exec($curl_connection);// perform our request

//      echo "<br>result: " . print_r($result,true) . '<br>';

        curl_close($curl_connection);// close the connection

        return $result;

    }

}
