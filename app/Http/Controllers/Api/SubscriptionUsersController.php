<?php

namespace App\Http\Controllers\Api;

use App\Models\Subscription;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class SubscriptionUsersController
 * @package App\Http\Controllers\Api
 */
class SubscriptionUsersController extends Controller
{
    /**
     *
     */
    const PROGRAM_USER = 5;
    const QUOTER = 1;
    const ACTIVE = 1;
    const NOT_ACTIVE = 0;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function getSubscriptions(Request $request)
    {
        $data = $this->validate($request, [
            'token' => 'required|max:32',
            'username' => 'required:max:32',
            'email' => 'required'
        ]);

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
                "data" => request()->all(),
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
