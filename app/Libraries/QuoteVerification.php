<?php

namespace App\Libraries;

use App\Http\Controllers\Api\UserQuoteController;
use App\Libraries\Utilities\AQLogger as LocalAQLogger;
use Dzineer\SMS\Facades\SMS;
use App\Facades\AQLog;

trait QuoteVerification {

  //  use LocalAQLogger;

    /**
     * @param $s
     * @param $quoteUnverified
     *
     * @return array
     */
    protected function sendStringSMS( $s, $quoteUnverified ) : array {
        $response = SMS::send( $s, [ "phone" => $quoteUnverified->phone ], function ( $sms ) use (
            $quoteUnverified
        ) {
            $sms->to( $quoteUnverified->phone );
        } );

        // $this->Log( "::gen_verify - verification response: " . $response . "" );

        // var_dump((array)$response);

        $responseArray = json_decode( $response, true );

        return $responseArray;
    }

    /**
     * @param int $code
     * @param $quoteUnverified
     *
     * @return array
     */
    protected function sendOTPSMS( int $code, $quoteUnverified ) : array {
        $response = SMS::send( strval( $code ), [ "phone" => $quoteUnverified->phone ], function ( $sms ) use (
            $quoteUnverified
        ) {
            $sms->to( $quoteUnverified->phone );
        } );

        AQLog::info([
            "QuoteVerification::sendOTPSMS - response" => $response,
        ]);

        // $this->Log( "::gen_verify - verification response: " . $response . "" );

        // var_dump((array)$response);

        $responseArray = json_decode( $response, true );

        return $responseArray;
    }

    /**
     * @param $responseData
     *
     * @return array
     */
    protected function getSentSMSResponse( $responseData ) : array {

        $ch = curl_init( $responseData['links']['self'] );

        // $auth_string = config( 'services.flowroute.access_key' ) . ":" . config( 'services.flowroute.secret_key' );
        // \Illuminate\Support\Facades\Log::info( self::class . "::gen_verify -  auth string : " . $auth_string );

        define( 'USER_AGENT', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.2309.372 Safari/537.36' );

        // curl_setopt($ch, CURLOPT_HTTPAUTH, "51314992:d0b1f7f6da117116f908fce5390f50e");

        curl_setopt( $ch, CURLOPT_USERAGENT, USER_AGENT );

        $auth_hash = config( 'services.flowroute.base64_encoded' );

       // $this->AQLog( "::onAction - base64_encode: " . $auth_hash . "" );

        // vnd.api+json - JSON API MIME Type
        curl_setopt( $ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/vnd.api+json',
            'Accept: */*',
            "Authorization: Basic $auth_hash"
            //   "Authorization: Basic $auth_hash"

        ] );

        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );

        //return response instead of outputting
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

        //execute the POST request
        $response = curl_exec( $ch );

        $this->AQLog( ":: - response: " . $response . "" );

        $responseArr = json_decode( $response, true );

        return $responseArr;
    }

    protected function getResponse( $id ) {

        AQLog::networkResponse("::getResponse - message id: " . $id . "\n");
        $res = SMS::getMessage( $id );
        AQLog::networkResponse( "::getResponse - response: " . $res . "" );
        return $res;
    }
}
