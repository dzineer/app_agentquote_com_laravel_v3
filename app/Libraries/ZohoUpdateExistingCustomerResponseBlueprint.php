<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-01-25
 * Time: 16:00
 */

namespace App\Libraries;


/**
 * Class ZohoExistingCustomerResponseBlueprint
 * @package App\Libraries
 */
class ZohoUpdateExistingCustomerResponseBlueprint implements ResponseBlueprint {
	/**
	 * @var
	 */
	private $data;

	/**
	 * ZohoExistingCustomerResponseBlueprint constructor.
	 *
	 * @param $data
	 */
	public function __construct($data) {
		$this->data = $data;
	}

	/**
	 * @return bool|mixed
	 */
	function build() {
		return ($this->data['code'] === 0) && ($this->data['message'] === 'Customer information has been saved.');
	}
}