<?php


namespace App\Api;

use App\Facades\AQLog;
use App\User;

/**
 * Class AffiliatesApiFacade
 * @package App\Api
 */
class AffiliatesApiFacade
{
    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAffiliate($data)
    {
        // Agent Quote's WHMCS Security

        $whmcsAPI = config('agentquote.whmcs_api');

        if ($data['token'] !== $whmcsAPI['token'] && $data['username'] !== $whmcsAPI['username']) {
            return response()->json([
                "message" => "Invalid Request",
                "success" => false,
            ]);
        }

        $user = User::where([
            "email" => $data['email']
        ])->first();

        if( !$user ) {
            return response()->json([
                "message" => "Affiliate does not exists.",
                "success" => false,
            ]);
        }

        if ( !$user->is_affiliate() ) {
            return response()->json([
                "message" => "User is not an affiliate.",
                "success" => false,
            ]);
        }

        return response()->json([
            "message" => "Affiliate received.",
            "success" => true,
        ]);


    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function disableAffiliate($data)
    {

        // Agent Quote's WHMCS Security

        $whmcsAPI = config('agentquote.whmcs_api');

        if ($data['token'] !== $whmcsAPI['token'] && $data['username'] !== $whmcsAPI['username']) {
            return response()->json([
                "message" => "Invalid Request",
                "success" => false,
            ]);
        }

        $user = User::where([
            "email" => $data['email']
        ])->first();

        if( !$user ) {
            return response()->json([
                "message" => "Affiliate does not exists.",
                "success" => false,
            ]);
        }

        if ( !$user->is_affiliate() ) {
            return response()->json([
                "message" => "User is not an affiliate.",
                "success" => false,
            ]);
        }

        $user->affiliate->update([
            'active' => 0
        ]);

        $user->update([
            'active' => 0
        ]);

        return response()->json([
            "message" => "Affiliate disabled.",
            "success" => true,
        ]);


    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function enableAffiliate($data)
    {
        // Agent Quote's WHMCS Security

        $whmcsAPI = config('agentquote.whmcs_api');

        if ($data['token'] !== $whmcsAPI['token'] && $data['username'] !== $whmcsAPI['username']) {
            return response()->json([
                "message" => "Invalid Request",
                "success" => false,
            ]);
        }

        $user = User::where([
            "email" => $data['email']
        ])->first();

        if( !$user ) {
            return response()->json([
                "message" => "Affiliate does not exists.",
                "success" => false,
            ]);
        }

        if ( !$user->is_affiliate() ) {
            return response()->json([
                "message" => "User is not an affiliate.",
                "success" => false,
            ]);
        }

        $user->affiliate->update([
            'active' => 1
        ]);

        $user->update([
            'active' => 1
        ]);

        return response()->json([
            "message" => "Affiliate disabled.",
            "success" => true,
        ]);
    }

}
