<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-01-25
 * Time: 16:00
 */

namespace App\Libraries;

/**
 * Class ZohoSubscriptionsHostedPageResponseBlueprint
 * @package App\Libraries
 */
class ZohoSubscriptionsHostedPageResponseBlueprint implements ResponseBlueprint {
	/**
	 * @var
	 */
	private $data;

	/**
	 * ZohoSubscriptionsHostedPageResponseBlueprint constructor.
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
		return ($this->data['code'] === 0);
	}
}