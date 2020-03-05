<?php

namespace App\Libraries;

class SMSErrorDispatch {
    public const SMS_GENERAL_ERROR = 0;
    public const SMS_DELIVERY_FAILURE = 1;
    public const SMS_REJECTED_BY_CARRIER = 2;

    /**
     * @param $reason
     * @param $quoteUnverified
     * @param string $hash_token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function dispatch( $reason, $quoteUnverified, string $hash_token ): \Illuminate\Http\JsonResponse {
        $resp = [
            "success" => false,
            "token"   => $hash_token,
            "message" => "SMS Delivery failure. Check your email for your 5-digit Code, then type it below.",
            //    "results" => $results
        ];

        switch( $reason ) {
            case self::SMS_DELIVERY_FAILURE:
                return response()->json( $resp );

            case self::SMS_GENERAL_ERROR:
                return response()->json( $resp );

            case self::SMS_REJECTED_BY_CARRIER:
                return response()->json( $resp );
        }


        return response()->json( $resp );
    }
}
