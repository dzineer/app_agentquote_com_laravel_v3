<?php


namespace App\Http\Controllers\Api;

use App\Api\ProductUsersApiFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Facades\AQLog;

error_reporting(E_ALL);
ini_set('display_errors', 1);

class ProductUsersApiController extends Controller {

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
    public function assignUserProduct(Request $request) {

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

        AQLog::info( json_encode([
            "request all" => request()->all(),
        ]) );

        $data = $this->validate($request, [
            'token' => 'required|max:32',
            'username' => 'required:max:32',
            'whmcs_email' => 'required:max:128',
            'whmcs_product_id' => 'required:max:128',
            'whmcs_token_request',
            'whmcs_affiliate',
            'whmcs_password',
            'whmcs_company',
            'whmcs_firstname',
            'whmcs_lastname',
            'whmcs_street',
            'whmcs_city',
            'whmcs_state_abbrev',
            'whmcs_postcode',
            'whmcs_domain'
        ]);


        return (new ProductUsersApiFacade())->assignUserProduct($request->all());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function removeUserProduct(Request $request) {

        // return "hey";

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

        AQLog::info( json_encode([
            "data" => request()->all(),
        ]) );

        Log::info(json_encode([
            "data" => request()->all(),
        ]));

        $data = $this->validate($request, [
            'token' => 'required|max:32',
            'username' => 'required:max:32',
            'whmcs_email' => 'required:max:128',
            'whmcs_product_id' => 'required:max:128',
            //    'user_id' => 'required:max:32',
        ]);

        return (new ProductUsersApiFacade())->removeUserProduct($data);
    }

}
