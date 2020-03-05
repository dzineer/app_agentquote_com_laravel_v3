<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SuperUserScope implements Scope
{
    const SUPER_USER_TYPE = 1;
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('type_id', '=', self::SUPER_USER_TYPE);
    }

    public function remove(Builder $builder, Model $model)
    {

    }
}