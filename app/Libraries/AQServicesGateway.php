<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 11/12/18
 * Time: 3:57 PM
 */

namespace App\Libraries;

/**
 * Class AQServicesGateway
 * @package App\Libraries
 */
class AQServicesGateway extends AQGateway {

	/**
	 * @param $headers
	 * @param $api
	 * @param $api_key
	 *
	 * @return mixed
	 */
	public function jverify( $api ) {

		$data = json_decode( file_get_contents('php://input') );


		if ( ! $data ) {
			$output = [ "success" => false, "message" => "Data invalid" ];
			return $output;
		}

		$api_url = AQSecurityConfig::getStoreAPI( $api );

		$json_payload = json_encode( $data, true );

		$headr = array();
		$json_data = $this->request('post', $api_url, $headr, $json_payload, true );

		return $json_data;
	}

}