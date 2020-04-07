<?php

namespace App\Http\Controllers;

use App\Contracts\FlowrouteMessageContract;
use App\Libraries\FlowrouteSMSClientWrapper;
use App\Libraries\SMSFlowrouteMessageBuilderBuilder;
use DZFlowroute\FlowrouteNumbersAndMessagingClient as FlowrouteClient;

use Illuminate\Http\Request;

class SMSTestingController extends Controller
{
    public function index() {
        $client = new FlowrouteSMSClientWrapper(
            new FlowrouteClient(
                env('FLOWROUTE_ACCESS_KEY'),
                env('FLOWROUTE_SECRET_KEY')
            )
        );

        $messages = $client->getMessages();

        $response = $client->send(
            new SMSFlowrouteMessageBuilderBuilder(
                new FlowrouteMessageContract(
                    '8882234773', 'test'
                )
            )
        );
    }
}
