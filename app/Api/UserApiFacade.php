<?php


namespace App\Api;

use App\Facades\AQLog;
use App\User;

/**
 * Class UserApiFacade
 * @package App\Api
 */
class UserApiFacade
{
    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function disableUser($data) {

        $whmcsAPI = config('agentquote.whmcs_api');

        if ($data['token'] !== $whmcsAPI['token'] && $data['username'] !== $whmcsAPI['username']) {

            AQLog::info(json_encode([
                "message" => "Invalid Request",
                "data" => request()->all(),
                "success" => false,
            ]));

            return response()->json([
                "message" => "Invalid Request",
                "success" => false,
            ]);
        }

        $user = User::where([
            "email" => $data['whmcs_email']
        ])->first();

        if (!$user) {

            AQLog::info(json_encode([
                "message" => "User does not exists.",
                "success" => false,
            ]));

            return response()->json([
                "message" => "User does not exists.",
                "success" => false,
            ]);
        }

        $user->update([
            'active' => 0
        ]);

        AQLog::info(json_encode([
            "message" => "User disabled.",
            "ok" => true,
            "success" => true,
        ]));

        return response()->json([
            "message" => "User disabled.",
            "ok" => true,
            "success" => true,
        ]);
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function enableUser($data)
    {
        // Agent Quote's WHMCS Security

        $whmcsAPI = config('agentquote.whmcs_api');

        if ($data['token'] !== $whmcsAPI['token'] && $data['username'] !== $whmcsAPI['username']) {

            AQLog::info(json_encode([
                "message" => "Invalid Request",
                "success" => false,
            ]));

            return response()->json([
                "message" => "Invalid Request",
                "success" => false,
            ]);
        }

        $user = User::where([
            "email" => $data['whmcs_email']
        ])->first();

        if (!$user) {

            AQLog::info(json_encode([
                "message" => "User does not exists.",
                "success" => false,
            ]));

            return response()->json([
                "message" => "User does not exists.",
                "success" => false,
            ]);
        }

        $user->update([
            'active' => 1
        ]);

        AQLog::info(json_encode([
            "message" => "User enabled.",
            "ok" => true,
            "success" => true,
        ]));

        return response()->json([
            "message" => "User enabled.",
            "ok" => true,
            "success" => true,
        ]);
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser($data)
    {
        // Agent Quote's WHMCS Security

        $whmcsAPI = config('agentquote.whmcs_api');

        if ($data['token'] !== $whmcsAPI['token'] && $data['username'] !== $whmcsAPI['username']) {

            AQLog::info(json_encode([
                "message" => "Invalid Request",
                "success" => false,
            ]));

            return response()->json([
                "message" => "Invalid Request",
                "success" => false,
            ]);
        }

        $user = User::where([
            "email" => $data['whmcs_email']
        ])->first();

        if (!$user) {

            AQLog::info(json_encode([
                "message" => "User does not exists.",
                "success" => false,
            ]));

            return response()->json([
                "message" => "User does not exists.",
                "success" => false,
            ]);
        }

        AQLog::info(json_encode([
            "message" => "User received.",
            "success" => true,
        ]));

        return response()->json([
            "message" => "User received.",
            "success" => true,
        ]);
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword($data)
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

        $user->update([
            'password' => $data['whmcs_password']
        ]);


        AQLog::info( json_encode([
            "message" => "Password Changed",
            'password' => $data['whmcs_password']
        ]) );

        return response()->json([
            "message" => "User password updated.",
            "okay" => true,
            "success" => true
        ]);
    }

}
