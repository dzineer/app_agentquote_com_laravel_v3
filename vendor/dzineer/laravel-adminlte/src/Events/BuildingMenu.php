<?php

namespace Dzineer\LaravelAdminLte\Events;

use Dzineer\LaravelAdminLte\Menu\Builder;

class BuildingMenu
{
    public $menu;

    public function __construct(Builder $menu)
    {
        $this->menu = $menu;
    }
}
