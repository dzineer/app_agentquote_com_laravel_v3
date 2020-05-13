<?php
namespace App\Http\Controllers\Resources\Api\v2;

use App\Facades\AQLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Api\UserApiFacade;

/**
 * Class UsersApiController
 * @package App\Http\Controllers\Resources\Api\v2
 */
class UsersApiController extends Controller
{
    public $version = 'v2';

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
    public function disableUser(Request $request)
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
            'whmcs_email' => 'required'
        ]);

        return (new UserApiFacade())->disableUser($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function enableUser(Request $request)
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
            'whmcs_email' => 'required'
        ]);

        return (new UserApiFacade())->enableUser($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function getUser(Request $request)
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
            'whmcs_email' => 'required'
        ]);

        return (new UserApiFacade())->getUser($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function changePassword(Request $request)
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
            'whmcs_email' => 'required',
            'whmcs_password' => 'required'
        ]);

        return (new UserApiFacade())->changePassword($data);
    }
}
