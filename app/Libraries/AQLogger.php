<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Log;

class AQLogger {
    public function log($s) {
        Log::channel('agentquoteLog')->info($s);
    }

    public function info($s) {
        Log::channel('agentquoteLog')->info($s);
    }

    public function network($s) {
        Log::channel('agentquoteNetworkLog')->info($s);
    }

    public function networkResponse($s) {
        Log::channel('agentquoteNetworkResponseLog')->info("\nNETWORK RESPONSE\n$s\n");
    }

    public function networkReceived($s) {
        Log::channel('agentquoteNetworkReceivedLog')->info("\nNETWORK RECEIVED\n$s\n");
    }

    public function errors($s) {
        Log::channel('agentquoteErrorsLog')->info("\nERRORS THROWN\n$s\n");
    }

    public function quote($s) {
        Log::channel('agentquoteQuoteLog')->info("\nQUOTE LOG\n$s\n");
    }
}
