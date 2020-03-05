<?php

namespace App;

use App\Models\AffiliateGroup;
use App\Models\AffiliateGroupUser;
use App\Scopes\AdminUserScope;

class AdminUser extends User
{
    public static function boot() {
        parent::boot();

        static::addGlobalScope(new AdminUserScope);
    }
}
