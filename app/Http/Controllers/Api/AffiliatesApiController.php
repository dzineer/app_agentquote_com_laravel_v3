<?php

namespace App\Http\Controllers\Api;

use App\Facades\AQLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Api\AffiliatesApiFacade;
use Illuminate\Support\Facades\Log;

class AffiliatesApiController extends Controller
{
    /**
     * @return bool
     */
    private function isAllowed() {
        return true;
        return '140.82.47.226' === request()->ip();
    }

    public function getAffiliate(Request $request)
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

        return (new AffiliatesApiFacade())->getAffiliate($data);
    }

    public function addAffiliate(Request $request) {
        $data = $this->validate($request, [
            'name' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required'
        ]);

        return (new AffiliatesApiFacade())->storeAffiliate($data);
    }

    public function disableAffiliate(Request $request)
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

        return (new AffiliatesApiFacade())->disableAffiliate($data);
    }

    public function enableAffiliate(Request $request)
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

        return (new AffiliatesApiFacade())->enableAffiliate($data);
    }

}
