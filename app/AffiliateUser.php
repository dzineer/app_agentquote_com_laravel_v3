<?php

namespace App;

use App\Scopes\AffiliateUserScope;

class AffiliateUser extends User
{
    public static function boot() {
        parent::boot();

        static::addGlobalScope(new AffiliateUserScope());
    }
}
