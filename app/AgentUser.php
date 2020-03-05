<?php

namespace App;

use App\Scopes\ProgramUserScope;

class AgentUser extends User
{
    public static function boot() {
        parent::boot();

        static::addGlobalScope(new ProgramUserScope());
    }
}
