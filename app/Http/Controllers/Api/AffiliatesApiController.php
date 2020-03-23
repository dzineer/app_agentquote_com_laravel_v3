<?php

namespace App\Http\Controllers\Api;

use App\Facades\AQLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Api\AffiliatesApiFacade;

class AffiliatesApiController extends Controller
{
    public function getAffiliate(Request $request)
    {
        $data = $this->validate($request, [
            'token' => 'required|max:32',
            'username' => 'required:max:32',
            'email' => 'required'
        ]);

        return (new AffiliatesApiFacade())->getAffiliate($data);
    }

    public function disableAffiliate(Request $request)
    {
        $data = $this->validate($request, [
            'token' => 'required|max:32',
            'username' => 'required:max:32',
            'email' => 'required'
        ]);

        return (new AffiliatesApiFacade())->disableAffiliate($data);
    }

    public function enableAffiliate(Request $request)
    {
        $data = $this->validate($request, [
            'token' => 'required|max:32',
            'username' => 'required:max:32',
            'email' => 'required'
        ]);

        return (new AffiliatesApiFacade())->enableAffiliate($data);
    }

}
