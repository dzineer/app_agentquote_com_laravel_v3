<?php

namespace App\Http\Controllers\Resources\Api\v2;

use App\Http\Controllers\Controller;
use App\Api\v2\ProductUsersApiFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Facades\AQLog;

error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * @OA\Info(
 *  description="Product User Api",
 *  version="2.0.0",
 *  title="AQ2E Product User Api",
 * )
 */

/**
 * Class ProductUsersApiController
 * @package App\Http\Controllers\Resources\Api\v2
 */
class ProductUsersApiController extends Controller {

    /**
     * @return bool
     */
    private function isAllowed() {
        return true;
        return '140.82.47.226' === request()->ip();
    }

    /**
     * @OA\Post(
     *  path="/api/user.assignUserProduct",
     *  tags={"assignUserProduct"},
     *  summary="Assign User a Product",
     *  operationId="assignUserProduct",
     *
     *  @OA\Parameter(
     *    name="token",
     *    description="Authentication Token id",
     *    in="query",
     *    required=true,
     *    @OA\Schema(
     *      type="string"
     *    )
     *  ),
     *  @OA\Parameter(
     *    name="username",
     *    description="Authentication Token Password",
     *    in="query",
     *    required=true,
     *    @OA\Schema(
     *      type="string"
     *    )
     *  ),
     *  @OA\Parameter(
     *    name="whmcs_email",
     *    description="WHMCS User's email address",
     *    in="query",
     *    required=true,
     *    @OA\Schema(
     *      type="string"
     *    )
     *  ),
     *  @OA\Parameter(
     *    name="whmcs_product_id",
     *    description="WHMCS Product's id",
     *    in="query",
     *    required=true,
     *    @OA\Schema(
     *      type="string"
     *    )
     *  ),
     *  @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\MediaType(
     *      mediaType="application/json"
     *    )
     *   )
     *
     * )
     */

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
            'whmcs_product_id' => 'required:max:128'
        ]);

        return (new ProductUsersApiFacade())->assignUserProduct($request->all());
    }

    /**
     * @OA\Post(
     *  path="/api/user.removeUserProduct",
     *  tags={"removeUserProduct"},
     *  summary="Remove User Product",
     *  operationId="removeUserProduct",
     *
     *  @OA\Parameter(
     *    name="token",
     *    description="Authentication Token id",
     *    in="query",
     *    required=true,
     *    @OA\Schema(
     *      type="string"
     *    )
     *  ),
     *  @OA\Parameter(
     *    name="username",
     *    description="Authentication Token Password",
     *    in="query",
     *    required=true,
     *    @OA\Schema(
     *      type="string"
     *    )
     *  ),
     *  @OA\Parameter(
     *    name="whmcs_email",
     *    description="WHMCS User's email address",
     *    in="query",
     *    required=true,
     *    @OA\Schema(
     *      type="string"
     *    )
     *  ),
     *  @OA\Parameter(
     *    name="whmcs_product_id",
     *    description="WHMCS Product's id",
     *    in="query",
     *    required=true,
     *    @OA\Schema(
     *      type="string"
     *    )
     *  ),
     *  @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\MediaType(
     *      mediaType="application/json"
     *    )
     *   )
     *
     * )
     */

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

        return (new ProductUsersApiFacade())->removeUserProduct($request->all());
    }

    /**
     * @OA\Post(
     *  path="/api/user.disableProduct",
     *  tags={"disableUser"},
     *  summary="Disable User Product",
     *  operationId="disableUser",
     *
     *  @OA\Parameter(
     *    name="token",
     *    description="Authentication Token id",
     *    in="query",
     *    required=true,
     *    @OA\Schema(
     *      type="string"
     *    )
     *  ),
     *  @OA\Parameter(
     *    name="username",
     *    description="Authentication Token Password",
     *    in="query",
     *    required=true,
     *    @OA\Schema(
     *      type="string"
     *    )
     *  ),
     *  @OA\Parameter(
     *    name="whmcs_email",
     *    description="WHMCS User's email address",
     *    in="query",
     *    required=true,
     *    @OA\Schema(
     *      type="string"
     *    )
     *  ),
     *  @OA\Parameter(
     *    name="whmcs_product_id",
     *    description="WHMCS Product's id",
     *    in="query",
     *    required=true,
     *    @OA\Schema(
     *      type="string"
     *    )
     *  ),
     *  @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\MediaType(
     *      mediaType="application/json"
     *    )
     *   )
     *
     * )
     */

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function disableUserProduct(Request $request) {

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

        return (new ProductUsersApiFacade())->disableUserProduct($request->all());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function enableUserProduct(Request $request) {

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

        return (new ProductUsersApiFacade())->enableUserProduct($request->all());
    }

}
