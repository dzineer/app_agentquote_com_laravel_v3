<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 11/12/18
 * Time: 3:57 PM
 */

namespace App\Libraries;

use App\Models\Affiliate;
use App\Models\AffiliateCoupon;
use App\Models\BillingCoupon;
use App\User;

class ZohoGateway extends AQGateway {

	public function create_hosted_page( $headers, $api, $api_key ) {

		if ( false ) {
			$output = [ "success" => false, "message" => "Bam!." ];
			echo json_encode( $output );
			exit;
		}

		$data = json_decode( file_get_contents('php://input') );
		// echo json_encode($data, true); exit;

		if ( ! $data ) {
			$output = [ "success" => false, "message" => "Data invalid" ];
			echo json_encode( $output );
			exit;
		}

		$username = $data->user->login_id;

		$u = User::where('email', $username)->first();

		if ( $u ) {
			$output = [ "success" => false, "message" => "Login Id Already Exists." ];
			echo json_encode( $output );
			exit;
		}

		$api_url = $api;

		// return [ "success" => false , "data" => $data->customer->email ];
		// return [ "success" => true , "url" => $api_url ];
		// $json_payload = $data;
		// return [ "success" => true , "url" => $json_payload ];

		$headr = $headr = ZohoHeaderBuilder::build($headers);

		// echo print_r( $headr, true ); exit;

		$check_exising_acct_url = 'https://subscriptions.zoho.com/api/v1/customers?email_contains='.$data->customer->email;

		$result = $this->request('get', $check_exising_acct_url, $headr, array() );
		$data_arr = json_decode( $result, true );
		$customers_data = $data_arr['customers'];

		// return [ "success" => false , "result" => $customers_data ];

		$check_existing_acct_url = 'https://subscriptions.zoho.com/api/v1/customers?email_contains='.$data->customer->email;
		$data_arr = $this->request('get', $check_existing_acct_url, $headr, array(), true );
		$customers_data = $data_arr['customers'];

		// return [ "success" => false , "result" => $customers_data[0] ];

		$customer_exists = false;
		$subscriptions = array();

		if ( count($customers_data) ) {
			$customer_id = $customers_data[0]['customer_id'];
			// return [ "success" => false , "message" => "You are already subscribed to this product.", "data" => $customer_id ];
			$customer_exists = true;
		}

		if ($customer_exists) {

			// do we have the mobile quoter ?
			$find_new_plan = "Mobile Quoter";
			$new_plan_found = false;

			$check_existing_subscriptions_url = 'https://subscriptions.zoho.com/api/v1/subscriptions?customer_id='.$customer_id;
			$data_arr = $this->request('get', $check_existing_subscriptions_url, $headr, array(), true );
			// return [ "success" => false , "result" => "existing customer", "message" => $data_arr ];
			$subscriptions = $data_arr['subscriptions'];

			if ( count($subscriptions) ) {
				foreach( $subscriptions as $subscription ) {
					if( $subscription['plan_name'] === $find_new_plan ) {
						$new_plan_found = true;
					}
				}
			}

			if ($new_plan_found) {
				return [ "success" => false , "message" => "You are already subscribed to this product." ];
			}

		}

		$json_payload = json_encode( $data, true );
		$json_data = $this->request('post', $api_url, $headr, $json_payload, true );
		// return [ "success" => false , "url" => $result ];
		// return [ "success" => true , "url" => $json_data ];
		// return [ "success" => true , "url" => $json_data['url'] ];
		return [ "success" => true , "url" => $json_data['hostedpage']['url'] ];
	}

	public function create_mobile_quoter( $headers, $api, $api_key ) {

		if ( false ) {
			$output = [ "success" => false, "message" => "Bam!." ];
			echo json_encode( $output );
			exit;
		}

		$data = json_decode( file_get_contents('php://input') );
		// echo json_encode($data, true); exit;

		if ( ! $data ) {
			$output = [ "success" => false, "message" => "Data invalid" ];
			echo json_encode( $output );
			exit;
		}

		$username = $data->user->login_id;

		$u = User::where('email', $username)->first();

		if ( $u ) {
			$output = [ "success" => false, "message" => "Login Id Already Exists." ];
			echo json_encode( $output );
			exit;
		}

		$api_url = $api;

		// return [ "success" => false , "data" => $data->customer->email ];
		// return [ "success" => true , "url" => $api_url ];
		// $json_payload = $data;
		// return [ "success" => true , "url" => $json_payload ];

		$headr = $headr = ZohoHeaderBuilder::build($headers);

		// echo print_r( $headr, true ); exit;

		$check_exising_acct_url = 'https://subscriptions.zoho.com/api/v1/customers?email_contains='.$data->customer->email;

		$result = $this->request('get', $check_exising_acct_url, $headr, array() );
		$data_arr = json_decode( $result, true );
		$customers_data = $data_arr['customers'];

		// return [ "success" => false , "result" => $customers_data ];

		$check_existing_acct_url = 'https://subscriptions.zoho.com/api/v1/customers?email_contains='.$data->customer->email;
		$data_arr = $this->request('get', $check_existing_acct_url, $headr, array(), true );
		$customers_data = $data_arr['customers'];

		// return [ "success" => false , "result" => $customers_data[0] ];

		$customer_exists = false;
		$subscriptions = array();

		if ( count($customers_data) ) {
			$customer_id = $customers_data[0]['customer_id'];
			// return [ "success" => false , "message" => "You are already subscribed to this product.", "data" => $customer_id ];
			$customer_exists = true;
		}

		if ($customer_exists) {

			// do we have the mobile quoter ?
			$find_new_plan = "Mobile Quoter";
			$new_plan_found = false;

			$check_existing_subscriptions_url = 'https://subscriptions.zoho.com/api/v1/subscriptions?customer_id='.$customer_id;
			$data_arr = $this->request('get', $check_existing_subscriptions_url, $headr, array(), true );
			// return [ "success" => false , "result" => "existing customer", "message" => $data_arr ];
			$subscriptions = $data_arr['subscriptions'];

			if ( count($subscriptions) ) {
				foreach( $subscriptions as $subscription ) {
					if( $subscription['plan_name'] === $find_new_plan ) {
						$new_plan_found = true;
					}
				}
			}

			if ($new_plan_found) {
				return [ "success" => false , "message" => "You are already subscribed to this product." ];
			}

		}

		$json_payload = json_encode( $data, true );
		$json_data = $this->request('post', $api_url, $headr, $json_payload, true );
		// return [ "success" => false , "url" => $result ];
		// return [ "success" => true , "url" => $json_data ];
		// return [ "success" => true , "url" => $json_data['url'] ];
		return [ "success" => true , "url" => $json_data['hostedpage']['url'] ];
	}

	public function aqmeeting( $headers, $api, $api_key ) {

		$data   = json_decode(file_get_contents('php://input'));
		$json_data = '';
		$json_payload = '';

		$customer_id = 0;
		$subscription_id = 0;
		$new_plan_subscription_id = 0;
		$existing_customer = false;
		$subscriptions = array();

		$output = ["success" => false, "message" => $data];
		// echo json_encode($output);
		// exit;

		if ( ! $data ) {
			$output = [ "success" => false, "message" => "Data invalid" ];
			echo json_encode( $output );
			exit;
		}

		$headr = ZohoHeaderBuilder::build($headers);

		// okay we got a logged in existing user
		if (isset($data->existing_user) && $data->existing_user === true) {
			$check_existing_acct_url = 'https://subscriptions.zoho.com/api/v1/customers?email_contains='.$data->email;
			$data_arr = $this->request('get', $check_existing_acct_url, $headr, array(), true );
			$customers_data = $data_arr['customers'];

			if ( count($customers_data) ) {
				$customer_id = $customers_data[0]['customer_id'];
				$existing_customer = true;
				// return [ "success" => false , "result" => "existing customer", "message" => $customer_id ];
			} else {
				return [ "success" => false , "message" => "no existing customer" ];
			}

			$check_existing_subscriptions_url = 'https://subscriptions.zoho.com/api/v1/subscriptions?customer_id='.$customer_id;
			$data_arr = $this->request('get', $check_existing_subscriptions_url, $headr, array(), true );
			// return [ "success" => false , "result" => "existing customer", "message" => $data_arr ];
			$subscriptions = $data_arr['subscriptions'];

			// do we have the AQ Meeting? ?
			$find_new_plan = "AQ Meeting";
			$base_new_plan_found = false;
			$plan_code = 'aqmeeting';
			$subscription_data = array();

			if ( count($subscriptions) ) {
				foreach( $subscriptions as $subscription ) {
					$subscription_id = $subscription['subscription_id'];
					if( $subscription['plan_name'] === $find_new_plan ) {
						$base_new_plan_found = true;
						$new_plan_subscription_id = $subscription['subscription_id'];
						return [ "success" => false , "message" => "You are already subscribed to this product" ];
					}
				}
			}

			$check_existing_subscriptions_url = 'https://subscriptions.zoho.com/api/v1/subscriptions/'.$subscription_id;
			$subscription_data = $this->request('get', $check_existing_subscriptions_url, $headr, array(), true );
			$card_data = $subscription_data['subscription']['card'];
			$card_id = $card_data['card_id'];

			$customers_url = 'https://subscriptions.zoho.com/api/v1/customers/' . $customer_id;

			$customer_info = ExistingCustomerUpdate::Create(
				new CustomerAQMeetingCustomFieldsBluePrint(
					$customer_id,
					[
						["label" => "aqm_u", "value" => $data->email],
						["label" => "aqm_p", "value" => sha1(rand(1,1000))]
					]
				)
			);

			$json_payload = json_encode( $customer_info, true );
			$data_arr = $this->request('put', $customers_url, $headr, $json_payload, true );
			// return [ "success" => false , "data" => $data_arr ];

			$subscriptions_url = 'https://subscriptions.zoho.com/api/v1/subscriptions';

			$info = ExistingUserNewSubscription::Create(
				new AQMeetingSubscriptionBluePrint($customer_id, $card_id, $plan_code)
			);

			// return [ "success" => false , "data" => $info ];

			$json_payload = json_encode( $info, true );
			//$data_arr = $this->request('post', $subscriptions_url, $headr, $json_payload, true );
			//$url =  '/completed/?p='.sha1(rand(1,1000));
			//return [ "success" => true , "url" => $url, "result" => $data_arr ];
			//return [ "success" => false , "message" => $customers_data[0] ];

 		} else {

			$api_url = $api;

			// we still need to make sure that they dont have aqmeeting

			$check_existing_acct_url = 'https://subscriptions.zoho.com/api/v1/customers?email_contains='.$data->customer->email;
			$data_arr = $this->request('get', $check_existing_acct_url, $headr, array(), true );
			$customers_data = $data_arr['customers'];

			if ( count($customers_data) ) {
				$customer_id = $customers_data[0]['customer_id'];
				$existing_customer = true;
			}

			if ($existing_customer) {

				$check_existing_subscriptions_url = 'https://subscriptions.zoho.com/api/v1/subscriptions?customer_id='.$customer_id;
				$data_arr = $this->request('get', $check_existing_subscriptions_url, $headr, array(), true );
				// return [ "success" => false , "result" => "existing customer", "message" => $data_arr ];
				$subscriptions = $data_arr['subscriptions'];

				// do we have the AQ Meeting? ?
				$find_new_plan = "AQ Meeting";

				$data->customer_id = $customer_id;

				$customers_url = 'https://subscriptions.zoho.com/api/v1/customers/' . $customer_id;

				$customer_info = ExistingCustomerUpdate::Create(
					new CustomerAQMeetingCustomFieldsBluePrint(
						$customer_id,
						[
							["label" => "aqm_u", "value" => $data->customer->email],
							["label" => "aqm_p", "value" => sha1(rand(1,1000))]
						]
					)
				);

				$json_payload = json_encode( $customer_info, true );
				$data_arr = $this->request('put', $customers_url, $headr, $json_payload, true );

				return [ "success" => false , "message" => $data_arr ];

				if ( count($subscriptions) ) {
					foreach( $subscriptions as $subscription ) {
						if( $subscription['plan_name'] === $find_new_plan ) {
							return [ "success" => false , "message" => "You are already subscribed to this product." ];
						}
					}
				}

			}

			// if we get this far, we don't have this product

			$json_payload = json_encode( $data, true );
			$json_data = $this->request('post', $api_url, $headr, $json_payload, true );

			// return [ "success" => false , "json_data" => $json_data ];
			// return [ "success" => true , "url" => $json_data ];
			// return [ "success" => true , "url" => $json_data['url'] ];

			// return [ "success" => true , "url" => $json_data['hostedpage']['url'] ];
		}

		$hosted_page_api = 'https://subscriptions.zoho.com/api/v1/hostedpages/newsubscription';

		$json_data = $this->request('post', $hosted_page_api, $headr, $json_payload, true );
		return [ "success" => true , "url" => $json_data['hostedpage']['url'] ];

	}

	public function microsite_addon( $headers, $api, $api_key ) {

		$data   = json_decode(file_get_contents('php://input'));
		$output = ["success" => false, "message" => $data];
		$json_data = '';
		$json_payload = '';

		// echo json_encode($output);
		// exit;

		if ( ! $data ) {
			$output = [ "success" => false, "message" => "Data invalid" ];
			echo json_encode( $output );
			exit;
		}

		$api_url = $api;

		$headr = ZohoHeaderBuilder::build($headers);

		$check_existing_acct_url = 'https://subscriptions.zoho.com/api/v1/customers?email_contains='.$data->user->email;
		$data_arr = $this->request('get', $check_existing_acct_url, $headr, array(), true );
		$customers_data = $data_arr['customers'];

		// return [ "success" => false , "result" => $customers_data[0] ];

		if ( count($customers_data) ) {
			$customer_id = $customers_data[0]['customer_id'];
			// return [ "success" => false , "result" => "existing customer", "data" => $customer_id ];
		} else {
			return [ "success" => false , "message" => "no existing customer" ];
		}

		$check_existing_subscriptions_url = 'https://subscriptions.zoho.com/api/v1/subscriptions?customer_id='.$customer_id;
		$data_arr = $this->request('get', $check_existing_subscriptions_url, $headr, array(), true );
		// return [ "success" => false , "result" => "existing customer", "data" => $data_arr ];
		$subscriptions = $data_arr['subscriptions'];

		// do we have the mobile quoter ?
		$find_base_plan = "Mobile Quoter";
		$find_new_plan = "Microsite Plan";
		$base_plan_found = false;
		$base_new_plan_found = false;

		// return [ "success" => false , "data_arr" => $data_arr ];

		if ( count($subscriptions) ) {
			foreach( $subscriptions as $subscription ) {
				if( $subscription['plan_name'] === $find_base_plan ) {
					$base_plan_found = true;
					$subscription_id = $subscription['subscription_id'];
				} else if( $subscription['plan_name'] === $find_new_plan ) {
					$base_new_plan_found = true;
				}
			}
		} else {
			return [ "success" => false , "message" => "no existing subscriptions" ];
		}

		if (!$base_plan_found) { // houston we have a problem
			return [ "success" => false , "message" => "You are required to have the Mobile Quoter to add a microsite." ];
		}

		if ($base_new_plan_found) { // houston we have a problem
			return [ "success" => false , "message" => "You are already subscribed to this product." ];
		}

		$plan_code = 'aq2e_microsite';

		$check_existing_subscriptions_url = 'https://subscriptions.zoho.com/api/v1/subscriptions/'.$subscription_id;
		$subscription_data = $this->request('get', $check_existing_subscriptions_url, $headr, array(), true );
		$card_data = $subscription_data['subscription']['card'];
		$card_id = $card_data['card_id'];
		// $customers_data = $data_arr['customers'];
		// return [ "success" => false , "data_arr" => $card_data ];
		// we can now subscribe to the microsite
		$customers_url = 'https://subscriptions.zoho.com/api/v1/customers/' . $customer_id;
		$customer_info = ExistingCustomerUpdate::Create(
			new CustomerMicrositeCustomFieldBluePrint( $customer_id, ["label" => "microsite_id", "value" => $data->user->microsite_id] )
		);
		// return [ "success" => false , "data" => $customer_info ];
		$json_payload = json_encode( $customer_info, true );
		$data_arr = $this->request('put', $customers_url, $headr, $json_payload, true );
		// return [ "success" => false , "data" => $data_arr ];
		$subscriptions_url = 'https://subscriptions.zoho.com/api/v1/subscriptions';
		$info = ExistingUserNewSubscription::Create(
			new MicrositeSubscriptionBluePrint($customer_id, $card_id, $plan_code)
		);
		// return [ "success" => false , "data" => $info ];
		$json_payload = json_encode( $info, true );
		// $data_arr = $this->request('post', $subscriptions_url, $headr, $json_payload, true );
		// $url =  '/completed/?p='.sha1(rand(1,1000));
		//return [ "success" => true , "url" => $url, "result" => $data_arr ];

		$hosted_page_api = 'https://subscriptions.zoho.com/api/v1/hostedpages/newsubscription';

		$json_data = $this->request('post', $hosted_page_api, $headr, $json_payload, true );
		return [ "success" => true , "url" => $json_data['hostedpage']['url'] ];
	}

	public function create_aq2e_hosted_page( $headers, $api, $api_key ) {

		$data = json_decode( file_get_contents('php://input') );
		// echo json_encode($data, true); exit;
		if ( ! $data ) {
			$output = [ "success" => false, "message" => "Data invalid" ];
			echo json_encode( $output );
			exit;
		}

		$api_url = $api;

		// return [ "success" => true , "url" => $api_url ];
		// $json_payload = $data;
		// return [ "success" => true , "url" => $json_payload ];

		$headr = $headr = ZohoHeaderBuilder::build($headers);

		// echo print_r( $headr, true ); exit;

		$check_exisitng_acct_url = 'https://subscriptions.zoho.com/api/v1/customers?email_contains='.$data->customer->email;

		$result = $this->request('get', $check_exisitng_acct_url, $headr, array() );
		$data_arr = json_decode( $result, true );
		$customers_data = $data_arr['customers'];

		// return [ "success" => false , "result" => $customers_data ];

		if ( count($customers_data) ) {
			$customer_id = $customers_data[0]['customer_id'];
			$data->customer->customer_id = $customer_id;
			// return [ "success" => false , "result" => "existing customer", "customer" => $customers_data[0]['customer_id'], "data" => $data->customer ];
		}

		$json_payload = json_encode( $data, true );

		$result = $this->request('post', $api_url, $headr, $json_payload );

		$json_data = json_decode( $result, true );

		// return [ "success" => false , "json_data" => $json_data ];
		// return [ "success" => true , "url" => $json_data ];
		// return [ "success" => true , "url" => $json_data['url'] ];

		return [ "success" => true , "url" => $json_data['hostedpage']['url'] ];
	}

	public function get_coupon( $headers, $api, $api_key ) {

		$data = json_decode( file_get_contents('php://input') );
		// echo json_encode($data, true); exit;
		if ( ! $data ) {
			$output = [ "success" => false, "message" => "Data invalid" ];
			echo json_encode( $output );
			exit;
		}

		// make sure it is upper case

		$coupon = strtoupper( ltrim(rtrim(trim($data->coupon))) );
		$affiliate_coupon = AffiliateCoupon::where("coupon", $coupon)->first();
		$affiliate = null;
		$billing_coupon = null;

		if ($affiliate_coupon) {

			$affiliate = Affiliate::find($affiliate_coupon['affiliate_id']);

			if ($affiliate) {
				$billing_coupon = BillingCoupon::find($affiliate_coupon['billing_coupon_id']);
				if (!$billing_coupon) {
					$output = [ "success" => false, "message" => $billing_coupon ];
					echo json_encode( $output );
					exit;
				}
			}
		} else {
			$output = [ "success" => false, "message" =>  "invalid coupon data" ];
			echo json_encode( $output );
			exit;
		}

		$api_url = $api;

		$api_url .= $billing_coupon['coupon'];

		$json_payload = json_encode( $data, true );

		$headr = $headr = ZohoHeaderBuilder::build($headers);
		$json_data = $this->request('get', $api_url, $headr, [], true );

		return [ "success" => true , "result" => $json_data, "affiliate" => $affiliate->name ];
	}

	public function complete_subscription( $headers, $api_url ) {

		$result = $this->request( 'get', $api_url, $headers, [] );
		// echo print_r($result, true); exit;
		// $api_url="https://subscriptions.zoho.com/api/v1/invoices/1617857000000072422?accept=pdf";
		// $result = $this->request( 'post', $api_url, $headers, [] );
		$json_data = json_decode( $result, true );
		//echo "<pre>";
		// echo print_r( $json_data, true ); exit;

		if ( $json_data[ 'status' ] != 'success' ) {
			return [ "success" => false , "message" => $json_data[ 'message' ] ];
		}
		// echo print_r($result, true); exit;
		// return [ "success" => false , "message" => $json_data ];
		return $json_data[ 'data' ];

		// process_subscription_records( $json_data );
		// exit;
	}
}