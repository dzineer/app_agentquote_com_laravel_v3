<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-01-22
 * Time: 14:01
 */

namespace App\Libraries;

/**
 * Class ExistingCustomerUpdate
 * @package App\Libraries
 */
class ExistingCustomerUpdate implements ZohoSubscription {
	/**
	 * @param SubscriptionBlueprint $blueprint
	 *
	 * @return mixed
	 */
	static public function Create(SubscriptionBlueprint $blueprint) {
		return $blueprint->build();
	}
}