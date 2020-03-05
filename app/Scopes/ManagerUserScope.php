<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ManagerUserScope implements Scope
{
    const MANAGER_USER_TYPE = 4;

    public function apply(Builder $builder, Model $model)
    {
        $builder->where('type_id', '=', self::MANAGER_USER_TYPE);
    }

    public function remove(Builder $builder, Model $model)
    {

    }
}