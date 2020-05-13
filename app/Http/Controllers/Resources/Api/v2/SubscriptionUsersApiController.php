<?php

namespace App\Http\Controllers\Resources\Api\v2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Api\SubscriptionUsersApiFacade;
use Illuminate\Support\Facades\Log;

/**
 * Class SubscriptionUsersApiController
 * @package App\Http\Controllers\Resources\Api\v2
 */
class SubscriptionUsersApiController extends Controller
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
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function getSubscriptions(Request $request)
    {
        if (!$this->isAllowed()) {

            Log::info( json_encode([
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

        // Agent Quote's WHMCS Security

        return (new SubscriptionUsersApiFacade())->getSubscriptions($request->all());
    }
}
