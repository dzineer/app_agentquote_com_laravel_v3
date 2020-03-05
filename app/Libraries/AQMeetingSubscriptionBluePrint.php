<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-01-22
 * Time: 14:06
 */

namespace App\Libraries;

/**
 * Class MicrositeSubscriptionBluePrint
 * @package App\Libraries
 */
class AQMeetingSubscriptionBluePrint implements SubscriptionBlueprint {
	/**
	 * @var
	 */
	private $customer_id;
	/**
	 * @var
	 */
	private $card_id;
	/**
	 * @var
	 */
	private $plan_code;

	/**
	 * MicrositeSubscriptionBluePrint constructor.
	 *
	 * @param $customer_id
	 * @param $card_id
	 * @param $plan_code
	 */
	public function __construct($customer_id, $card_id, $plan_code) {
		$this->customer_id = $customer_id;
		$this->card_id = $card_id;
		$this->plan_code = $plan_code;
	}

	/**
	 * @return \stdClass
	 */
	public function build() {
		$data = new \stdClass();
		$data->customer_id = $this->customer_id;
		$data->card_id = $this->card_id;
		$data->plan = new \stdClass();
		$data->auto_collect = true;
		$data->plan->plan_code = $this->plan_code;

		return $data;
	}
}