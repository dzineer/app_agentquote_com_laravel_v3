<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-02-25
 * Time: 16:01
 */

namespace App\Factories;

use App\Blueprints\DZBlueprint;

/**
 * Class QuoteFactory
 * @package App\Factories
 */
class QuoteFactory implements DZFactory {

	/**
	 * @param DZBlueprint $blueprint
	 *
	 * @return mixed
	 */
	public static function Make(DZBlueprint $blueprint) {
		return $blueprint->build();
	}

}