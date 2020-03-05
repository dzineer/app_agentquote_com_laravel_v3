<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-03-05
 * Time: 17:26
 */

namespace App\Subscriptions;

use App\Subscriptions\AQMeetingSubscription;
use App\Subscriptions\MobileQuoterSubscription;

class SubscriptionsDispatcher {

	/**
	 * @param $product
	 * @param $event
	 * @param $post_data
	 */
	public function dispatch($product, $event, $post_data): void {
		if ($event === 'subscription') {

			switch ($product) {

				case 'mobilequoter':

					if ($event === 'completed') {
						(new AQMeetingSubscription($post_data))->subscribe();
					}
					break;

				case 'aqmeeting':
					if ($event === 'completed') {
						(new MobileQuoterSubscription($post_data))->subscribe();
					}
					break;

			}

		}
	}
}