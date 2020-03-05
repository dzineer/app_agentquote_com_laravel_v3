<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;

class SessionTimeout {
    protected $session;
    protected $timeout = 1;

    public function handle($request, Closure $next)
    {
        $timeout = 30;

        if (! \Session::has('lastActivityTime')) {
            Auth::logout();
        }

        if ($request->path() !== 'login' && \Session::has('lastActivityTime') && (time() - \Session::get('lastActivityTime')) > $timeout) {
            \Session::flush();
            Auth::logout();
        }

        \Session::put('lastActivityTime', time());
        return $next($request);
    }

}
