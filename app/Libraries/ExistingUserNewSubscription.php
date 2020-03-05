<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-01-22
 * Time: 14:01
 */

namespace App\Libraries;

/**
 * Class ExistingUserNewSubscription
 * @package App\Libraries
 */
class ExistingUserNewSubscription implements ZohoSubscription {
	/**
	 * @param SubscriptionBlueprint $blueprint
	 *
	 * @return mixed
	 */
	static public function Create(SubscriptionBlueprint $blueprint) {
		return $blueprint->build();
	}
}