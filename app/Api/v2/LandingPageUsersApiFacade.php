<?php

namespace App\Api\v2;

use App\Models\LandingPageUser;
use App\Models\Subscription;
use App\User;

/**
 * Class LandingPageUsersApiFacade
 * @package Api
 */
class LandingPageUsersApiFacade
{
    /**
     *
     */
    const ACTIVE = 1;
    /**
     *
     */
    const NOT_ACTIVE = 0;

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLandingPageUser($data)
    {
        // Agent Quote's WHMCS Security

        $whmcsAPI = config('agentquote.whmcs_api');

        if ($data['token'] !== $whmcsAPI['token'] && $data['username'] !== $whmcsAPI['username']) {
            return response()->json([
                "message" => "Invalid Request",
                "data" => request()->all(),
                "success" => false,
            ]);
        }

        $user = User::where([
            "email" => $data['email']
        ])->first();

        if( !$user ) {
            return response()->json([
                "message" => "User does not exists.",
                "success" => false,
            ]);
        }

        $landingPageUser = LandingPageUser::where([ 'user_id' => $user->id ])->first();

        if( !$landingPageUser ) {
            return response()->json([
                "message" => "User does not have a landing page.",
                "success" => false,
            ]);
        }

        return response()->json([
            "message" => "Landing Page User received.",
            "success" => true,
        ]);
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function disableLandingPageUser($data)
    {
        // Agent Quote's WHMCS Security

        $whmcsAPI = config('agentquote.whmcs_api');

        if ($data['token'] !== $whmcsAPI['token'] && $data['username'] !== $whmcsAPI['username']) {
            return response()->json([
                "message" => "Invalid Request",
                "data" => request()->all(),
                "success" => false,
            ]);
        }

        $user = User::where([
            "email" => $data['email']
        ])->first();

        if( !$user ) {
            return response()->json([
                "message" => "User does not exists.",
                "success" => false,
            ]);
        }

        $landingPageUser = LandingPageUser::where([ 'user_id' => $user->id ])->first();

        if( !$landingPageUser ) {
            return response()->json([
                "message" => "User does not have a landing page.",
                "success" => false,
            ]);
        }

        $landingPageUser->update([
            'active' => self::NOT_ACTIVE
        ]);

        $subscription = Subscription::where(["user_id" => $user->id, "product_id" => 2])
            ->first();

        $subscription->update([
            "active" => self::NOT_ACTIVE
        ]);

        return response()->json([
            "message" => "Landing Page User disabled.",
            "success" => true,
        ]);
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function enableLandingPageUser($data)
    {
        // Agent Quote's WHMCS Security

        $whmcsAPI = config('agentquote.whmcs_api');

        if ($data['token'] !== $whmcsAPI['token'] && $data['username'] !== $whmcsAPI['username']) {
            return response()->json([
                "message" => "Invalid Request",
                "data" => request()->all(),
                "success" => false,
            ]);
        }

        $user = User::where([
            "email" => $data['email']
        ])->first();

        if( !$user ) {
            return response()->json([
                "message" => "User does not exists.",
                "success" => false,
            ]);
        }

        $landingPageUser = LandingPageUser::where([ 'user_id' => $user->id ])->first();

        if( !$landingPageUser ) {
            return response()->json([
                "message" => "User does not have a landing page.",
                "success" => false,
            ]);
        }

        $landingPageUser->update([
            'active' => self::ACTIVE
        ]);

        $subscription = Subscription::where(["user_id" => $user->id, "product_id" => 2])
            ->first();

        $subscription->update([
            "active" => self::ACTIVE
        ]);

        return response()->json([
            "message" => "Landing Page User enabled.",
            "success" => true,
        ]);
    }
}
