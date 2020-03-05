<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 11/12/18
 * Time: 4:11 PM
 */

namespace App\Libraries;


/**
 * Class AQSecurityConfig
 * @package App\Libraries
 */
class AQSecurityConfig
{
	/**
	 * @return \Illuminate\Config\Repository|mixed
	 */
	public static function getAuth() {
		$auth = config('agentquote.auth');
		return $auth;
	}

	/**
	 * @return \Illuminate\Config\Repository|mixed
	 */
	public static function getAPIs() {
		$apis = config('agentquote.apis');
		return $apis;
	}

	/**
	 * @param $api_key
	 *
	 * @return bool|mixed
	 */
	public static function getStoreAPI( $api_key ) {
		$store_apis = config('agentquote.store.api');
		return array_key_exists( $api_key, $store_apis ) ? $store_apis[ $api_key ] : false;
	}

	/**
	 * @return \Illuminate\Config\Repository|mixed
	 */
	public static function getHeaders() {
		$headers = config('agentquote.security.headers');
		return $headers;
	}
}