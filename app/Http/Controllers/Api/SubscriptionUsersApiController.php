<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Api\SubscriptionUsersApiFacade;

/**
 * Class SubscriptionUsersApiController
 * @package App\Http\Controllers\Api
 */
class SubscriptionUsersApiController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
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

        return (new SubscriptionUsersApiFacade())->$this->getSubscriptions($data);
    }
}
