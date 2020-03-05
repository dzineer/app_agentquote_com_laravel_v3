<?php

namespace Dzineer\LaravelAdminLte\Menu\Filters;

use Dzineer\LaravelAdminLte\Menu\Builder;

interface FilterInterface
{
    public function transform($item, Builder $builder);
}
