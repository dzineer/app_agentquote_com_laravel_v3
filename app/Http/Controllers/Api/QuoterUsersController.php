<?php

namespace App\Http\Controllers\Api;

use App\Models\QuoterUser;
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
            "message" => "Landing Page User received.",
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

        $quoterUser->update( ['active' => 0 ] );

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

        $quoterUser->update( ['active' => 0 ] );

        return response()->json([
            "message" => "Quoter User enabled.",
            "data" => $quoterUser,
            "success" => true,
        ]);
    }


}
