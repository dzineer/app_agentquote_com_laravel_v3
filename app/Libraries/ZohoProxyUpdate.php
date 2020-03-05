<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 11/12/18
 * Time: 5:54 PM
 */

namespace App\Libraries;
use Illuminate\Http\Request;

/**
 * Class ZohoProxyUpdate
 * @package App\Libraries
 */
class ZohoProxyUpdate extends ProxyService {

	/**
	 * @param $auth
	 * @param $user
	 * @param $password
	 */
	public function authorize_request($auth, $user, $password ) {
		if( $user === $auth['userid'] && $password === $auth['password'] ) {
			$output = [ "success" => true, "token" => $auth['token'] ];
			echo json_encode( $output );
			exit;
		} else {
			$output = [ "success" => false, "message" => 'invalid credentials' ];
			echo json_encode( $output );
			exit;
		}
	}

	/**
	 * @param $auth
	 * @param $accountid
	 */
	public function authorize_account_id($auth, $accountid ) {
		if ( ! $accountid ) {
			$output = [ "success" => false, "message" => "Invalid Account Id" ];
			echo json_encode( $output );
			exit;
		}
	}

	/**
	 * @param $auth
	 * @param $token
	 */
	public function validate_token($auth, $token ) {
		if ( ! $token ) {
			$output = [ "success" => false, "message" => "Invalid Token" ];
			echo json_encode( $output );
			exit;
		}
	}

	/**
	 * @param $headers
	 * @param $api_key
	 *
	 * @return bool
	 */
	public function validate_api_key( $headers, $api_key ) {
		$apis = AQSecurityConfig::getAPIs();
		// echo print_r($apis,true); exit;
		return array_key_exists( $api_key, $apis ) ? $apis[ $api_key ] : false;
	}

	/**
	 * @param Request $request
	 *
	 * @return array
	 */
	public function process_request( Request $request ) {

		$hostedpage_id = $request->has('hostedpage_id') ? $request->input('hostedpage_id') : false;

		if ( ! $hostedpage_id ) {
			$output = [ "success" => false, "message" => "no hostedpage_id" ];
			echo json_encode( $output );
			exit;
		}

		$api_key = 'complete_subscription';
		$api = 'https://subscriptions.zoho.com/api/v1/hostedpages/';
		$api_url = $api . $hostedpage_id;

		$security = ZohoSecurityConfig::getHeaders();
		$headr = ZohoHeaderBuilder::build($security);

		// echo "<pre>";
		// echo print_r($headr,true);

		return $this->api_dispatch( $api_key, $api_url, $headr );
	}

	/**
	 * @param       $api_key
	 * @param       $api_url
	 * @param array $headers
	 *
	 * @return array
	 */
	private function api_dispatch( $api_key, $api_url, $headers=[] ) {
		switch( $api_key ) {
			case 'complete_subscription':
				$headers = ZohoSecurityConfig::getHeaders();
				$gateway = new ZohoGateway();
				$response = $gateway->complete_subscription( $headers, $api_url );
				$subscription = $response['subscription'];
				$invoice = $response['invoice'];
				$customer = $subscription['customer'];
				return ["success" => true, "subscription" => $subscription, "customer" => $customer, "invoice" => $invoice ];
		}
	}

}