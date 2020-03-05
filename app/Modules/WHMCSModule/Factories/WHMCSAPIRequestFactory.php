<?php

namespace App\Modules\WHMCSModule\Factories;

use App\Modules\WHMCSModule\Libraries\API\WHMCSAPIRequest;
use App\Modules\WHMCSModule\Libraries\API\WHMCSClientApi;
use App\Modules\WHMCSModule\Libraries\API\WHMCSProductsApi;

class WHMCSAPIRequestFactory {
    public static function newClientsAPI() {
        return new WHMCSClientApi( new WHMCSAPIRequest() );
    }
    public static function newProductsAPI() {
        return new WHMCSProductsApi( new WHMCSAPIRequest() );
    }
}
