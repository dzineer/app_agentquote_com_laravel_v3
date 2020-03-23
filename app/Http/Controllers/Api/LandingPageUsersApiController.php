<?php

namespace App\Http\Controllers\Api;

use Api\LandingPageUsersApiFacade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class LandingPageUsersApiController
 * @package App\Http\Controllers\Api
 */
class LandingPageUsersApiController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function getLandingPageUser(Request $request)
    {
        $data = $this->validate($request, [
            'token' => 'required|max:32',
            'username' => 'required:max:32',
            'email' => 'required'
        ]);

        return (new LandingPageUsersApiFacade())->getLandingPageUser($data);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function disableLandingPageUser(Request $request)
    {
        $data = $this->validate($request, [
            'token' => 'required|max:32',
            'username' => 'required:max:32',
            'email' => 'required'
        ]);

        return (new LandingPageUsersApiFacade())->disableLandingPageUser($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function enableLandingPageUser(Request $request)
    {
        $data = $this->validate($request, [
            'token' => 'required|max:32',
            'username' => 'required:max:32',
            'email' => 'required'
        ]);

        return (new LandingPageUsersApiFacade())->enableLandingPageUser($data);
    }

}
