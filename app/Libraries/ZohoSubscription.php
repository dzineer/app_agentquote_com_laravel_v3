<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-01-22
 * Time: 14:01
 */

namespace App\Libraries;

/**
 * Interface ZohoSubscription
 * @package App\Libraries
 */
interface ZohoSubscription {
	/**
	 * @param SubscriptionBlueprint $blueprint
	 *
	 * @return mixed
	 */
	static function Create(SubscriptionBlueprint $blueprint);
}