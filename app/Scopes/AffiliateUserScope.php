<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class AffiliateUserScope implements Scope
{
    const AFFILIATE_USER_TYPE = 2;

    public function apply(Builder $builder, Model $model)
    {
        $builder->where('type_id', '=', self::AFFILIATE_USER_TYPE);
    }

    public function remove(Builder $builder, Model $model)
    {

    }
}