<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-01-22
 * Time: 14:05
 */

namespace App\Libraries;

/**
 * Interface SubscriptionBlueprint
 * @package App\Libraries
 */
interface SubscriptionBlueprint {
	/**
	 * @return mixed
	 */
	function build();
}