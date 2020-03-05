<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 11/12/18
 * Time: 4:07 PM
 */

namespace App\Libraries;

use Illuminate\Http\Request;

/**
 * Class AQProxyService
 * @package App\Libraries
 */
class AQProxyService extends ProxyService
{

	/**
	 * AQProxyService constructor.
	 */
	public function __construct() {
	}

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
	 * @param $accountid
	 */
	public function authorize_account_id($accountid ) {
		if ( ! $accountid ) {
			$output = [ "success" => false, "message" => "Invalid Account Id" ];
			echo json_encode( $output );
			exit;
		}
	}

	/**
	 * @param $token
	 */
	public function validate_token($token ) {
		if ( ! $token ) {
			$output = [ "success" => false, "message" => "Invalid Token" ];
			echo json_encode( $output );
			exit;
		}
	}

	/**
	 * @param $headers
	 * @param $hash_key
	 *
	 * @return bool|mixed
	 */
	public function validate_hash_key( $headers, $hash_key ) {
		$apis = AQSecurityConfig::getAPIs();
		return isset( $headers['X-Agentquote-Api'] ) && array_key_exists( $hash_key, $apis );
	}

	/**
	 * @param $hash
	 *
	 * @return bool|mixed
	 */
	public function hash2APIkey( $hash ) {
		$apis = AQSecurityConfig::getAPIs();
		return array_key_exists( $hash, $apis ) ? $apis[ $hash ] : false;
	}

	/**
	 * @param Request $request
	 *
	 * @return array|mixed
	 */
	public function process_request( Request $request ) {

		// get all headers
		$received_headers = WebHeaders::getallheaders();
		// get security vars
		$auth = AQSecurityConfig::getAuth();

		// 1. Do we have a token?
		// get token if one was provided, then since we use a static token, static token equals to provided token?
		$token = isset( $received_headers['Token'] ) && $received_headers['Token'] === $auth['token'];

		// did we get a token and if so is it valid?
		// if this fails, we end here.
		if ($token) {
			$this->validate_token( $token );
		}

		$user = $request->has('userid') ? $request->input('userid') : false;
		$password = $request->has('password')  ? $request->input('password') : false;

		// if we receive a user and password then validate it and return a token
		if ( $user && $password ) {
			$this->authorize_request( $auth, $user, $password );
		}
/*
		$output = [ "success" => false, "message" => $received_headers ];
		echo json_encode( $output );
		exit;*/

		// since we arrived here means we have a valid token
		// validate our Accountid
		$accountid = isset( $received_headers['Accountid'] ) && $received_headers['Accountid'] === $auth['accountid'];
		$this->authorize_account_id( $accountid );

		// did get receive an api header request?

		if ( ! array_key_exists('X-Agentquote-Api', $received_headers ) ) {
			$output = [ "success" => false, "message" => "Invalid Header" ];
			return $output;
		}

		// get and validate existing api key

		$api_hash_key = trim( $received_headers['X-Agentquote-Api'] );

		// return [ "success" => false, "message" => $api_hash_key ];

		if ( ! $this->validate_hash_key( $received_headers, $api_hash_key ) ) {
			$output = [ "success" => false, "message" => "Invalid Header" ];
			return $output;
		}

		$aq_proxy_api = $this->hash2APIkey( $api_hash_key );

		// echo $api; exit;

		// all is good so run API Request
		return $this->api_dispatch( $aq_proxy_api );
	}

	/**
	 * @param $aq_proxy_api
	 *
	 * @return array|mixed
	 */
	private function api_dispatch( $aq_proxy_api ) {

		switch( $aq_proxy_api ) {
			case 'mobile_quoter':
				$gateway = new ZohoSubscriptionsGateway();
				$output = $gateway->zoho_request( $aq_proxy_api );
				return $output;
			// new mmlq subscribee
			case 'affiliate_program_complete':
				$gateway = new ZohoSubscriptionsGateway();
				$output = $gateway->zoho_request( $aq_proxy_api );
				return $output;
			case 'microsite':
				$gateway = new ZohoSubscriptionsGateway();
				$output = $gateway->zoho_request( $aq_proxy_api );
				return $output;
			case 'aqmeeting':
				$gateway = new ZohoSubscriptionsGateway();
				$output = $gateway->zoho_request( $aq_proxy_api );
				return $output;
			// get coupon of Affiliate. If it is valid then continue to lookup the coupon from Zoho
			case 'coupons':
				$gateway = new ZohoSubscriptionsGateway();
				$output = $gateway->zoho_request( $aq_proxy_api );
				return $output;

			case 'jverify':
				$gateway = new AQServicesGateway();
				$output = $gateway->jverify( $aq_proxy_api );
				return $output;

			default:
				$output = [ "success" => false, "message" => "Invalid Request" ];
				return $output;
		}
	}

}
