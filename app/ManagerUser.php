<?php

namespace App;

use App\Scopes\ManagerUserScope;

class ManagerUser extends User
{
    public static function boot() {
        parent::boot();

        static::addGlobalScope(new ManagerUserScope());
    }
}
