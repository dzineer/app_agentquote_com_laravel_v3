<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 11/12/18
 * Time: 4:11 PM
 */

namespace App\Libraries;


/**
 * Class ZohoSecurityConfig
 * @package App\Libraries
 */
class ZohoSecurityConfig
{

	/**
	 * @return \Illuminate\Config\Repository|mixed
	 */
	public static function getAuth() {
		$auth = config('zoho.auth');
		return $auth;
	}

	/**
	 * @return \Illuminate\Config\Repository|mixed
	 */
	public static function getAPIs() {
		$apis = config('zoho.apis');
		return $apis;
	}

	/**
	 * @param $hash
	 *
	 * @return \Illuminate\Config\Repository|mixed
	 */
	public static function hash2Plan( $hash ) {
		$apis = config('zoho.hash2plan');
		return $apis;
	}

	/**
	 * @param $app
	 * @param $api_key
	 * @param $api_key_sub
	 *
	 * @return bool
	 */
	public static function getAPI($app, $api_key, $api_key_sub = '') {
		$apis = self::getAPIs();

/*
		'current_version' => '1',
		'1' => [
			'subscriptions' => [
				'subscriptions' => 'https://subscriptions.zoho.com/api/v1/subscriptions',
				'new' => [
					'hostedpages' => 'https://subscriptions.zoho.com/api/v1/hostedpages/newsubscription'
				],
				'customers' => 'https://subscriptions.zoho.com/api/v1/customers',
				'coupons' => 'https://subscriptions.zoho.com/api/v1/coupons/'
			]
		]
*/

		$ver = self::getAPIVersion();
		$found = array_key_exists( $ver, $apis );
		if (! $found) return false;
		$subset = $apis[ $ver ];
		$found = array_key_exists( $app, $subset );
		if (! $found) return false;
		$app_subset =  $subset[ $app ];

		$found = array_key_exists( $api_key, $app_subset );
		if ( $found && ! empty($api_key_sub) ) {
			$app_subset_subset = $app_subset[ $api_key ];
			$api_key_sub_found = array_key_exists( $api_key_sub, $app_subset_subset );
			if ( ! $api_key_sub_found ) {
				return false;
			}
			return $app_subset_subset[ $api_key_sub ];
		}
		return $app_subset[ $api_key ];
	}

	/**
	 * @return \Illuminate\Config\Repository|mixed
	 */
	public static function getAPIVersion() {
		$ver = config('zoho.apis.current_version');
		return $ver;
	}

	/**
	 * @return \Illuminate\Config\Repository|mixed
	 */
	public static function getPlans() {
		$plans = config('zoho.plans');
		return $plans;
	}

	/**
	 * @return \Illuminate\Config\Repository|mixed
	 */
	public static function getHeaders() {
		$headers = config('zoho.security.headers');
		return $headers;
	}
}