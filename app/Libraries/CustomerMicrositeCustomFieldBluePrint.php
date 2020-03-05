<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-01-22
 * Time: 14:06
 */

namespace App\Libraries;

/**
 * Class CustomerMicrositeCustomFieldBluePrint
 * @package App\Libraries
 */
class CustomerMicrositeCustomFieldBluePrint implements SubscriptionBlueprint {
	/**
	 * @var
	 */
	private $customer_id;
	/**
	 * @var
	 */
	private $custom_fields;

	/**
	 * CustomerMicrositeCustomFieldBluePrint constructor.
	 *
	 * @param $customer_id
	 * @param $custom_fields
	 */
	public function __construct($customer_id, $custom_fields) {
		$this->customer_id = $customer_id;
		$this->custom_fields = $custom_fields;
	}

	/**
	 * @return \stdClass
	 */
	public function build() {
		$data = new \stdClass();
		$data->customer_id = $this->customer_id;
		$data->custom_fields = array();

		$data->custom_fields[0]  =  new \stdClass();
		$data->custom_fields[0]->label  = $this->custom_fields["label"];
		$data->custom_fields[0]->value  = $this->custom_fields["value"];

		return $data;
	}
}