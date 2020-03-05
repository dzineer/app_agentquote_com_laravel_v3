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
class CustomerAQMeetingCustomFieldsBluePrint implements SubscriptionBlueprint {
	/**
	 * @var
	 */
	private $customer_id;
	/**
	 * @var
	 */
	private $custom_fields;

	/**
	 * CustomerAQMeetingCustomFieldsBluePrint constructor.
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

		foreach( $this->custom_fields as $custom_field ) {
			$field = new \stdClass();
			$field->label  = $custom_field["label"];
			$field->value  = $custom_field["value"];
			$data->custom_fields[] = $field;
		}

		return $data;
	}
}