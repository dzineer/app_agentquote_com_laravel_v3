<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ProgramUserScope implements Scope
{
    const PROGRAM_USER_TYPE = 5;

    public function apply(Builder $builder, Model $model)
    {
        $builder->where('type_id', '=', self::PROGRAM_USER_TYPE);
    }

    public function remove(Builder $builder, Model $model)
    {

    }
}