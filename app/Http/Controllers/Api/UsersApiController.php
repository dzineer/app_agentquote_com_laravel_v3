<?php
namespace App\Http\Controllers\Api;

use App\Facades\AQLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Api\UserApiFacade;

/**
 * Class UsersApiController
 * @package App\Http\Controllers\Api
 */
class UsersApiController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function disableUser(Request $request)
    {
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
        $data = $this->validate($request, [
            'token' => 'required|max:32',
            'username' => 'required:max:32',
            'whmcs_email' => 'required',
            'whmcs_password' => 'required'
        ]);

        return (new UserApiFacade())->changePassword($data);
    }
}
