<?php

namespace App\Libraries\Utilities;

trait AQLogger {
    private function AQLog($msg) {
        if ($this->debug) {
            \Illuminate\Support\Facades\Log::info( self::class . $msg );
        }
    }
}
