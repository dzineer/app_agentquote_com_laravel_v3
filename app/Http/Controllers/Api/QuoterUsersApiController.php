<?php

namespace App\Http\Controllers\Api;

use App\Facades\AQLog;
use App\Models\QuoterUser;
use App\Models\Subscription;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Api\QuoterUsersApiFacade;

/**
 * Class QuoterUsersController
 * @package App\Http\Controllers\Api
 */
class QuoterUsersApiController extends Controller
{
    /**
     * @return bool
     */
    private function isAllowed() {
        return true;
        return '140.82.47.226' === request()->ip();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function getQuoterUser(Request $request)
    {
        if (!$this->isAllowed()) {

            AQLog::info( json_encode([
                "message" => "Invalid IP Address",
                "data" => request()->all(),
                "mode" => "debug",
                "ip" => request()->ip(),
                "ok" => false,
                "success" => false,
            ]) );

            return response()->json([
                "message" => "Invalid IP Address",
                "data" => request()->all(),
                "mode" => "debug",
                "ip" => request()->ip(),
                "ok" => false,
                "success" => false,
            ]);
        }

        $data = $this->validate($request, [
            'token' => 'required|max:32',
            'username' => 'required:max:32',
            'email' => 'required'
        ]);

        return (new QuoterUsersApiFacade())->getQuoterUser($data);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function disableQuoterUser(Request $request)
    {
        if (!$this->isAllowed()) {

            AQLog::info( json_encode([
                "message" => "Invalid IP Address",
                "data" => request()->all(),
                "mode" => "debug",
                "ip" => request()->ip(),
                "ok" => false,
                "success" => false,
            ]) );

            return response()->json([
                "message" => "Invalid IP Address",
                "data" => request()->all(),
                "mode" => "debug",
                "ip" => request()->ip(),
                "ok" => false,
                "success" => false,
            ]);
        }

        $data = $this->validate($request, [
            'token' => 'required|max:32',
            'username' => 'required:max:32',
            'email' => 'required'
        ]);

        return (new QuoterUsersApiFacade())->disableQuoterUser($data);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function enableQuoterUser(Request $request)
    {
        if (!$this->isAllowed()) {

            AQLog::info( json_encode([
                "message" => "Invalid IP Address",
                "data" => request()->all(),
                "mode" => "debug",
                "ip" => request()->ip(),
                "ok" => false,
                "success" => false,
            ]) );

            return response()->json([
                "message" => "Invalid IP Address",
                "data" => request()->all(),
                "mode" => "debug",
                "ip" => request()->ip(),
                "ok" => false,
                "success" => false,
            ]);
        }

        $data = $this->validate($request, [
            'token' => 'required|max:32',
            'username' => 'required:max:32',
            'email' => 'required'
        ]);

        return (new QuoterUsersApiFacade())->enableQuoterUser($data);
    }


}
