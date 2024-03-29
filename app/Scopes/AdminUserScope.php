<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class AdminUserScope implements Scope
{
    const ADMIN_USER_TYPE = 3;

    public function apply(Builder $builder, Model $model)
    {
        $builder->where('type_id', '=', self::ADMIN_USER_TYPE);
    }

    public function remove(Builder $builder, Model $model)
    {

    }
}