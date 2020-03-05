<?php

namespace App\Http\Middleware;

use App\Facades\AQLog;
use Closure;

class LogRouteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        AQLog::info(json_encode([
            'LOGGING REQUEST',
            serialize($request)
        ]));

        $response = $next($request);

        AQLog::info(json_encode([
            'LOGGING RESPONSE',
            serialize($response)
        ]));

        return $response;

    }
}
