<?php

namespace App\Api\v2;


use App\Models\Subscription;
use App\User;

class SubscriptionUsersApiFacade
{
    public function getSubscriptions($data)
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

        $subscriptions = Subscription::where(["user_id" => $user->id])->get();

        return response()->json([
            "message" => "Subscriptions",
            "data" => $subscriptions,
            "success" => true,
        ]);


    }
}
