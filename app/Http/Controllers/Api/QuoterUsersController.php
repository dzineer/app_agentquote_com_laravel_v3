<?php

namespace App\Http\Controllers\Api;

use App\Models\QuoterUser;
use App\Models\Subscription;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class QuoterUsersController
 * @package App\Http\Controllers\Api
 */
class QuoterUsersController extends Controller
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
    public function getWHMCSQuoterUser(Request $request)
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

        $quoterUser = QuoterUser::where([ 'user_id' => $user->id ])->first();

        if( !$quoterUser ) {
            return response()->json([
                "message" => "User does not have a Quoter.",
                "data" => request()->all(),
                "success" => false,
            ]);
        }

        return response()->json([
            "message" => "Quoter User received.",
            "data" => $quoterUser,
            "success" => true,
        ]);


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function disableWHMCSQuoterUser(Request $request)
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

        $quoterUser = QuoterUser::where([ 'user_id' => $user->id ])->first();

        if( !$quoterUser ) {
            return response()->json([
                "message" => "User does not have a Quoter.",
                "data" => request()->all(),
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
            "data" => $quoterUser,
            "success" => true,
        ]);


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function enableWHMCSQuoterUser(Request $request)
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

        $quoterUser = QuoterUser::where([ 'user_id' => $user->id ])->first();

        if( !$quoterUser ) {
            return response()->json([
                "message" => "User does not have a Quoter.",
                "data" => request()->all(),
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
            "data" => $quoterUser,
            "success" => true,
        ]);
    }


}
