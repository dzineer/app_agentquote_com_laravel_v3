<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 11/12/18
 * Time: 3:57 PM
 */

namespace App\Libraries;

class AQGateway {
	private function post_request($url, $header, $data) {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		$result = curl_exec($ch);
		curl_close($ch);

		return $result;
	}

	private function put_request($url, $header, $data) {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

		$result = curl_exec($ch);
		curl_close($ch);

		return $result;
	}

	protected function request( $request_type, $url, $header, $data, $decode = false ) {
		if( $request_type === 'get' ) {
			return $decode ? json_decode($this->get_request( $url, $header, $data ), true) : $this->get_request( $url, $header, $data );
		} else if ( $request_type === 'post' ) {
			return $decode ? json_decode($this->post_request( $url, $header, $data ), true) : $this->post_request( $url, $header, $data );
		} else if ( $request_type === 'put' ) {
			return $decode ? json_decode($this->put_request( $url, $header, $data ), true) : $this->post_request( $url, $header, $data );
		}
	}

	protected function get_request($url, $header, $data) {
		$ch = curl_init();

		$hds = config('zoho.security.headers');
		$headers = array();

		foreach( $hds as $key => $val ) {
			$headers[] = sprintf("%s: %s", $key, $val);
		}

		if( count($data) > 0 ) {
			$query = http_build_query($data);
			curl_setopt($ch, CURLOPT_URL, "$url?$query");
		} else {
			curl_setopt($ch, CURLOPT_URL, $url);
		}
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0 );
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);

		//https://subscriptions.zoho.com/api/v1/invoices/1617857000000072422?accept=pdf

		// dd($result);

		curl_close($ch);

		return $result;
	}
}