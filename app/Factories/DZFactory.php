<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-02-25
 * Time: 16:03
 */

namespace App\Factories;

use App\Blueprints\DZBlueprint;

interface DZFactory {
	public static function Make(DZBlueprint $blueprint);
}