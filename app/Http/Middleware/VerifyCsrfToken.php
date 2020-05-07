<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
	    '/user/otp',
	    '/user/verify',
	    '/user/jverify',
	    '/user/otl',
        '/ads/underwritten',
        '/ads/un',
        '/api/invite/confirmation',
        '/api/invites/new',
        '/api/app_module',
        '/invites/new',
        '/invites/admin/new',
        '/invites/manager/new',
        '/password/reset',
        '/password/reset/confirmation',
        '/api/affiliate.add'
    ];
}
