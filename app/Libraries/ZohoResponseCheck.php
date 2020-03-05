<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-01-25
 * Time: 12:19
 */

namespace App\Libraries;

/**
 * Class ZohoResponseCheck
 * @package App\Libraries
 */
class ZohoResponseCheck implements ResponseCheck {
	/**
	 * @param ResponseBlueprint $blueprint
	 *
	 * @return mixed
	 */
	public static function Check(ResponseBlueprint  $blueprint) {
		return $blueprint->build();
	}
}