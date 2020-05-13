<?php


namespace App\Api\v2;

use App\Facades\AQLog;
use App\Models\QuoterUser;
use App\Models\Subscription;
use App\User;

/**
 * Class QuoterUsersApiFacade
 * @package App\Api
 */
class QuoterUsersApiFacade
{
    /**
     *
     */
    const QUOTER = 1;
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
    public function getQuoterUser($data)
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
                "message" => "User does not exists.",
                "success" => false,
            ]);
        }

        $quoterUser = QuoterUser::where([ 'user_id' => $user->id ])->first();

        if( !$quoterUser ) {
            return response()->json([
                "message" => "User does not have a Quoter.",
                "success" => false,
            ]);
        }

        return response()->json([
            "message" => "Quoter User received.",
            "success" => true,
        ]);
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function disableQuoterUser($data)
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
                "message" => "User does not exists.",
                "success" => false,
            ]);
        }

        $quoterUser = QuoterUser::where([ 'user_id' => $user->id ])->first();

        if( !$quoterUser ) {
            return response()->json([
                "message" => "User does not have a Quoter.",
                "success" => false,
            ]);
        }

        $quoterUser->update( ['active' => self::NOT_ACTIVE ] );

        $subscription = Subscription::where(["user_id" => $user->id, "product_id" => self::QUOTER])->first();

        $subscription->update([
            "active" => self::NOT_ACTIVE
        ]);

        return response()->json([
            "message" => "Quoter User disabled.",
            "success" => true,
        ]);
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function enableQuoterUser($data)
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
                "message" => "User does not exists.",
                "success" => false,
            ]);
        }

        $quoterUser = QuoterUser::where([ 'user_id' => $user->id ])->first();

        if( !$quoterUser ) {
            return response()->json([
                "message" => "User does not have a Quoter.",
                "success" => false,
            ]);
        }

        $quoterUser->update( ['active' => 1 ] );

        $subscription = Subscription::where(["user_id" => $user->id, "product_id" => self::QUOTER])->first();

        $subscription->update([
            "active" => self::ACTIVE
        ]);

        return response()->json([
            "message" => "Quoter User enabled.",
            "success" => true,
        ]);
    }
}
