<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-01-22
 * Time: 14:33
 */

namespace App\Libraries;

/**
 * Class ZohoHeaderBuilder
 * @package App\Libraries
 */
class ZohoHeaderBuilder implements WebHeaderBuilder {
	/**
	 * @param $headers
	 *
	 * @return array|mixed
	 */
	public static function build($headers) {
		$headr = array();
		$headr[] = 'X-com-zoho-subscriptions-organizationid: ' . $headers['X-com-zoho-subscriptions-organizationid'];
		$headr[] = 'Authorization: ' . $headers['Authorization'];
		$headr[] = 'Content-Type: ' . $headers['Content-Type'];

		return $headr;
	}
}