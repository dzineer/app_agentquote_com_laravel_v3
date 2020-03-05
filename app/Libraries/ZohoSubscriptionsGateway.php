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

class ZohoSubscriptionsGateway extends AQGateway {

	private $test_mode = true;

	public function zoho_request( $api_key ) {

		switch( $api_key ) {
			case 'mobile_quoter':
				return $this->new_mobile_quoter_subscription();
			// new mmlq subscribee
			case 'microsite':
				return $this->microsite_addon();
			case 'affiliate_program_complete':
                return $this->affiliate_program_complete();
			case 'aqmeeting':
				return $this->aqmeeting();
			case 'coupons':
				return $this->get_coupon();
			default:
				$output = [ "success" => false, "message" => "Invalid Request" ];
				return $output;
		}
	}

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
			return $output;
		}

		$username = $data->user->login_id;

		$u = User::where('email', $username)->first();

		if ( $u ) {
			$output = [ "success" => false, "message" => "Login Id Already Exists." ];
			return $output;
		}

		$api_url = $api;
		$headr = $headr = ZohoHeaderBuilder::build($headers);
		$check_exising_acct_url = 'https://subscriptions.zoho.com/api/v1/customers?email_contains='.$data->customer->email;

		$result = $this->request('get', $check_exising_acct_url, $headr, array() );
		$data_arr = json_decode( $result, true );
		$customers_data = $data_arr['customers'];

		$check_existing_acct_url = 'https://subscriptions.zoho.com/api/v1/customers?email_contains='.$data->customer->email;
		$data_arr = $this->request('get', $check_existing_acct_url, $headr, array(), true );
		$customers_data = $data_arr['customers'];

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

		return [ "success" => true , "url" => $json_data['hostedpage']['url'] ];
	}

	public function new_aqmeeting_subscription() {
		$customer_exists = false;
		$subscriptions = array();
		$use_subscription = array();
		$find_new_plan = "Mobile Quoter";
		$new_plan_found = false;
		$customer_id = 0;
		if ( false ) {
			$output = [ "success" => false, "message" => "Bam!." ];
			return $output;
		}

		$data = json_decode( file_get_contents('php://input') );
		// echo json_encode($data, true); exit;

		if ( ! $data ) {
			$output = [ "success" => false, "message" => "Data invalid" ];
			return $output;
		}

		// TODO: step 1 - check if email already exists in the mobile quoter app

		$username = $data->user->login_id;
		$u = User::where('email', $username)->first();

		if ( $u ) {
			$output = [ "success" => false, "message" => "Login Id Already Exists." ];
			return $output;
		}

		// TODO: step 2 - check if email already exists as a zoho customer

		// prepare zoho required headers
		$headers = ZohoSecurityConfig::getHeaders();
		$headr = $headr = ZohoHeaderBuilder::build($headers);

		$customers_subscriptions_api_url = ZohoSecurityConfig::getAPI('subscriptions', 'customers' );
		$check_existing_acct_url = $customers_subscriptions_api_url . '?email_contains=' . $data->customer->email;
		$check_existing_acct_url .= '&status=active';

		$data_arr = $this->request('get', $check_existing_acct_url, $headr, array(), true );

		// valid request
		if (! ZohoResponseCheck::Check(
			new ZohoExistingCustomerResponseBlueprint( $data_arr )
		)) {
			return [ "success" => false , "message" => "Invalid data" ];
		}

		$customers_data = $data_arr['customers'];

		if ( count($customers_data) ) {
			// TODO: step 2a - only get first zoho customer
			$customer_id = $customers_data[0]['customer_id'];
			$customer_exists = true;
		}

		// TODO: step 2b - get existing customer's subscriptions
		if ($customer_exists) {

			$subscriptions_subscriptions_api_url = ZohoSecurityConfig::getAPI('subscriptions', 'subscriptions' );

			// make sure we have an active subscription
			$check_existing_subscriptions_url = $subscriptions_subscriptions_api_url . '?customer_id='.$customer_id;
			$check_existing_subscriptions_url .= '&status=live';

			$data_arr = $this->request('get', $check_existing_subscriptions_url, $headr, array(), true );

			// valid request
			if (! ZohoResponseCheck::Check(
				new ZohoSubscriptionsCustomerDetailsResponseBlueprint( $data_arr )
			)) {
				return [ "success" => false , "message" => "Invalid data" ];
			}

			$subscriptions = $data_arr['subscriptions'];

			// does the customer have subscriptions ?
			if ( count($subscriptions) ) {
				foreach( $subscriptions as $subscription ) {
					if( $subscription['plan_name'] === $find_new_plan ) {
						$new_plan_found = true;
						$use_subscription = $subscription;
						// return [ "success" => false , "message" => $use_subscription ];
					}
				}
			}

			if ($new_plan_found) {
				return [ "success" => false , "message" => "You are already subscribed to this product." ];
			}

			return [ "success" => false , "message" => "Does not have Mobile Quoter Plan" ];

		}

		// return [ "success" => false , "message" => 'No existing active customer.' ];

		$new_subscriptions_api_url = ZohoSecurityConfig::getAPI('subscriptions', 'new', 'hostedpages');

		$json_payload = json_encode( $data, true );
		$json_data = $this->request('post', $new_subscriptions_api_url, $headr, $json_payload, true );

		return [ "success" => true , "url" => $json_data['hostedpage']['url'] ];
	}

	public function new_mobile_quoter_subscription() {
		$customer_exists = false;
		$subscriptions = array();
		$use_subscription = array();
		$find_new_plan = "Mobile Quoter";
		$new_plan_found = false;
		$customer_id = 0;
		if ( false ) {
			$output = [ "success" => false, "message" => "Bam!." ];
			return $output;
		}

		$data = json_decode( file_get_contents('php://input') );
		// echo json_encode($data, true); exit;

		if ( ! $data ) {
			$output = [ "success" => false, "message" => "Data invalid" ];
			return $output;
		}

		// TODO: step 1 - check if email already exists in the mobile quoter app

		$username = $data->user->login_id;
		$u = User::where('email', $username)->first();

		if ( $u ) {
			$output = [ "success" => false, "message" => "Login Id Already Exists." ];
			return $output;
		}

		// TODO: step 2 - check if email already exists as a zoho customer

		// prepare zoho required headers
		$headers = ZohoSecurityConfig::getHeaders();
		$headr = $headr = ZohoHeaderBuilder::build($headers);

		$customers_subscriptions_api_url = ZohoSecurityConfig::getAPI('subscriptions', 'customers' );
		$check_existing_acct_url = $customers_subscriptions_api_url . '?email_contains=' . $data->customer->email;
		$check_existing_acct_url .= '&status=active';

		$data_arr = $this->request('get', $check_existing_acct_url, $headr, array(), true );

		// valid request
		if (! ZohoResponseCheck::Check(
			new ZohoExistingCustomerResponseBlueprint( $data_arr )
		)) {
			return [ "success" => false , "message" => "Invalid data" ];
		}

		$customers_data = $data_arr['customers'];

		if ( count($customers_data) ) {
			// TODO: step 2a - only get first zoho customer
			$customer_id = $customers_data[0]['customer_id'];
			$customer_exists = true;
		}

		// TODO: step 2b - get existing customer's subscriptions
		if ($customer_exists) {

			$subscriptions_subscriptions_api_url = ZohoSecurityConfig::getAPI('subscriptions', 'subscriptions' );

			// make sure we have an active subscription
			$check_existing_subscriptions_url = $subscriptions_subscriptions_api_url . '?customer_id='.$customer_id;
			$check_existing_subscriptions_url .= '&status=live';

			$data_arr = $this->request('get', $check_existing_subscriptions_url, $headr, array(), true );

			// valid request
			if (! ZohoResponseCheck::Check(
				new ZohoSubscriptionsCustomerDetailsResponseBlueprint( $data_arr )
			)) {
				return [ "success" => false , "message" => "Invalid data" ];
			}

			$subscriptions = $data_arr['subscriptions'];
			$another_subscription_found = false;

			// does the customer have subscriptions ?
			if ( count($subscriptions) ) {
				foreach( $subscriptions as $subscription ) {
					if( $subscription['plan_name'] === $find_new_plan ) {
						$new_plan_found = true;
						$use_subscription = $subscription;
						// return [ "success" => false , "message" => $use_subscription ];
					}
				}
			}

			if ($new_plan_found) {
				return [ "success" => false , "message" => "You are already subscribed to this product." ];
			}

			$info = new \stdClass();
			$info->customer_id = $customer_id;
			$info->plan = new \stdClass();
			$info->plan->plan_code = 'my_mobile_life_quoter';

			$json_payload = json_encode( $info, true );

			// return [ "success" => false , "message" => "Does not have Mobile Quoter Plan" ];
		} else { // no customer found
			$json_payload = json_encode( $data, true );
		}

		// return [ "success" => false , "message" => $json_payload ];

		$new_subscriptions_api_url = ZohoSecurityConfig::getAPI('subscriptions', 'new', 'hostedpages');
		$json_data = $this->request('post', $new_subscriptions_api_url, $headr, $json_payload, true );

		// valid request
		if (! ZohoResponseCheck::Check(
			new ZohoSubscriptionsHostedPageResponseBlueprint( $data_arr )
		)) {
			return [ "success" => false , "message" => $data_arr ];
		}

		return [ "success" => true , "url" => $json_data['hostedpage']['url'] ];
	}

	public function aqmeeting() {

		$data   = json_decode(file_get_contents('php://input'));

		$json_data = '';
		$json_payload = '';
		$customer_id = 0;
		$subscription_id = 0;
		$customer_exists = true;
		$new_plan_subscription_id = 0;
		$new_plan_found = false;
		$existing_customer = false;
		$subscriptions = array();

		$output = ["success" => false, "message" => $data];
		// echo json_encode($output);
		// exit;

		if ( ! $data ) {
			$output = [ "success" => false, "message" => "Data invalid ah oooh" ];
			return $output;
		}

		// okay we got a logged in existing user
		if (isset($data->existing_user) && $data->existing_user === true) {

			// prepare zoho required headers
			$headers = ZohoSecurityConfig::getHeaders();
			$headr = $headr = ZohoHeaderBuilder::build($headers);

			$customers_subscriptions_api_url = ZohoSecurityConfig::getAPI('subscriptions', 'customers' );
			$check_existing_acct_url = $customers_subscriptions_api_url . '?email_contains=' . $data->email;
			$check_existing_acct_url .= '&status=active';

			$data_arr = $this->request('get', $check_existing_acct_url, $headr, array(), true );

			// valid request
			if (! ZohoResponseCheck::Check(
				new ZohoExistingCustomerResponseBlueprint( $data_arr )
			)) {
				return [ "success" => false , "message" => "Invalid data" ];
			}

			$customers_data = $data_arr['customers'];

			if ( count($customers_data) ) {
				$customer_id = $customers_data[0]['customer_id'];
				$customer_exists = true;
			}

			if ( $customer_exists ) {

				$subscriptions_subscriptions_api_url = ZohoSecurityConfig::getAPI('subscriptions', 'subscriptions' );

				// make sure we have an active subscription
				$check_existing_subscriptions_url = $subscriptions_subscriptions_api_url . '?customer_id='.$customer_id;
				$check_existing_subscriptions_url .= '&status=live';

				$data_arr = $this->request('get', $check_existing_subscriptions_url, $headr, array(), true );

				// valid request
				if (! ZohoResponseCheck::Check(
					new ZohoSubscriptionsCustomerDetailsResponseBlueprint( $data_arr )
				)) {
					return [ "success" => false , "message" => "Invalid data err`" ];
				}

				$subscriptions = $data_arr['subscriptions'];

				// do we have the AQ Meeting? ?
				$find_new_plan = "AQ Meeting";
				$new_plan_found = false;
				$plan_code = 'aqmeeting';
				$subscription_data = array();

				// does the customer have subscriptions ?
				if ( count($subscriptions) ) {
					foreach( $subscriptions as $subscription ) {
						if( $subscription['plan_name'] === $find_new_plan ) {
							$new_plan_found = true;
							$use_subscription = $subscription;
							return [ "success" => false , "message" => $use_subscription ];
						}
					}
				}

				if ($new_plan_found) {
					return [ "success" => false , "message" => "You are already subscribed to this product.!!!" ];
				}

				// customer does not have the plan so lets update the customer with their new username and password
				$customers_subscriptions_api_url = ZohoSecurityConfig::getAPI('subscriptions', 'customers' );
				$customers_subscriptions_api_url .= '/' . $customer_id;

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
				$data_arr = $this->request('put', $customers_subscriptions_api_url, $headr, $json_payload, true );

				// valid request
				if (! ZohoResponseCheck::Check(
					new ZohoUpdateExistingCustomerResponseBlueprint( $data_arr )
				)) {
					return [ "success" => false , "message" => "Invalid data" ];
				}

				// now let's add the subscription
				// $customer_id

				return [ "success" => false , "message" => "You are not subscribed to this product." ];

			}

			// if we get here ... the customer does not exist in zoho subscriptions

			$info = new \stdClass();
			$info->customer_id = $customer_id;
			$info->plan = new \stdClass();
			$info->plan->plan_code = 'aqmeeting';

			$json_payload = json_encode($info, true);

			$new_subscriptions_api_url = ZohoSecurityConfig::getAPI('subscriptions', 'new', 'hostedpages');
			$json_data = $this->request('post', $new_subscriptions_api_url, $headr, $json_payload, true );

			// valid request
			if (! ZohoResponseCheck::Check(
				new ZohoSubscriptionsHostedPageResponseBlueprint( $data_arr )
			)) {
				return [ "success" => false , "message" => $data_arr ];
			}

			return [ "success" => true , "url" => $json_data['hostedpage']['url'] ];

 		} // ./isset($data->existing_user) && $data->existing_user === true
		else {

			// we still need to make sure that they dont have aqmeeting
			// prepare zoho required headers
			$headers = ZohoSecurityConfig::getHeaders();
			$headr = $headr = ZohoHeaderBuilder::build($headers);

			// if we get this far, we don't have this product

			$json_payload = json_encode( $data, true );
			$hosted_page_api = 'https://subscriptions.zoho.com/api/v1/hostedpages/newsubscription';
			$json_data = $this->request('post', $hosted_page_api, $headr, $json_payload, true );

			// valid request
			if (! ZohoResponseCheck::Check(
				new ZohoSubscriptionsHostedPageResponseBlueprint( $json_data )
			)) {
				return [ "success" => false , "message" => $json_data ];
			}

			return [ "success" => true , "url" => $json_data['hostedpage']['url'] ];

		}

	}

    public function affiliate_program_complete() {

        $customer_exists = false;
        $subscriptions = array();
        $use_subscription = array();
        $find_new_plan = "AQ2E Affiliate Program Complete";
        $new_plan_found = false;
        $customer_id = 0;
        if ( false ) {
            $output = [ "success" => false, "message" => "Bam!." ];
            return $output;
        }

        $data = json_decode( file_get_contents('php://input') );
        // echo json_encode($data, true); exit;

        if ( ! $data ) {
            $output = [ "success" => false, "message" => "Data invalid" ];
            return $output;
        }

        // TODO: step 1 - check if email already exists

        $username = $data->user->login_id;
        $u = User::where('email', $username)->first();

        if ( $u ) {
            $output = [ "success" => false, "message" => "Login Id Already Exists." ];
            return $output;
        }

        // TODO: step 2 - check if email already exists as a zoho customer

        // prepare zoho required headers
        $headers = ZohoSecurityConfig::getHeaders();
        $headr = $headr = ZohoHeaderBuilder::build($headers);

        $customers_subscriptions_api_url = ZohoSecurityConfig::getAPI('subscriptions', 'customers' );
        $check_existing_acct_url = $customers_subscriptions_api_url . '?email_contains=' . $data->customer->email;
        $check_existing_acct_url .= '&status=active';

        $data_arr = $this->request('get', $check_existing_acct_url, $headr, array(), true );

        // valid request
        if (! ZohoResponseCheck::Check(
            new ZohoExistingCustomerResponseBlueprint( $data_arr )
        )) {
            return [ "success" => false , "message" => "Invalid data" ];
        }

        $customers_data = $data_arr['customers'];

        if ( count($customers_data) ) {
            // TODO: step 2a - only get first zoho customer
            $customer_id = $customers_data[0]['customer_id'];
            $customer_exists = true;
        }

        // TODO: step 2b - get existing customer's subscriptions
        if ($customer_exists) {

            $subscriptions_subscriptions_api_url = ZohoSecurityConfig::getAPI('subscriptions', 'subscriptions' );

            // make sure we have an active subscription
            $check_existing_subscriptions_url = $subscriptions_subscriptions_api_url . '?customer_id='.$customer_id;
            $check_existing_subscriptions_url .= '&status=live';

            $data_arr = $this->request('get', $check_existing_subscriptions_url, $headr, array(), true );

            // valid request
            if (! ZohoResponseCheck::Check(
                new ZohoSubscriptionsCustomerDetailsResponseBlueprint( $data_arr )
            )) {
                return [ "success" => false , "message" => "Invalid data" ];
            }

            $subscriptions = $data_arr['subscriptions'];
            $another_subscription_found = false;

            // does the customer have subscriptions ?
            if ( count($subscriptions) ) {
                foreach( $subscriptions as $subscription ) {
                    if( $subscription['plan_name'] === $find_new_plan ) {
                        $new_plan_found = true;
                        $use_subscription = $subscription;
                        // return [ "success" => false , "message" => $use_subscription ];
                    }
                }
            }

            if ($new_plan_found) {
                return [ "success" => false , "message" => "You are already subscribed to this product." ];
            }

            $info = new \stdClass();
            $info->customer_id = $customer_id;
            $info->plan = new \stdClass();
            $info->plan->plan_code = 'aq2e_affiliate_program_complete';

            $json_payload = json_encode( $info, true );

            // return [ "success" => false , "message" => "Does not have Mobile Quoter Plan" ];
        } else { // no customer found
            $json_payload = json_encode( $data, true );
        }

        // return [ "success" => false , "message" => $json_payload ];

        $new_subscriptions_api_url = ZohoSecurityConfig::getAPI('subscriptions', 'new', 'hostedpages');
        $json_data = $this->request('post', $new_subscriptions_api_url, $headr, $json_payload, true );

        // valid request
        if (! ZohoResponseCheck::Check(
            new ZohoSubscriptionsHostedPageResponseBlueprint( $data_arr )
        )) {
            return [ "success" => false , "message" => $data_arr ];
        }

        return [ "success" => true , "url" => $json_data['hostedpage']['url'] ];
    }

	public function microsite_addon() {

		$data   = json_decode(file_get_contents('php://input'));
		// return ["success" => false, "message" => $data];
		$json_data = '';
		$json_payload = '';

		// echo json_encode($output)
		// exit;

		if ( ! $data ) {
			$output = [ "success" => false, "message" => "Data invalid" ];
			return $output;
		}

		// return [ "success" => false , "data" => $data ];

		$headers = ZohoSecurityConfig::getHeaders();
		$headr = $headr = ZohoHeaderBuilder::build($headers);

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

		$customers_url = 'https://subscriptions.zoho.com/api/v1/customers/' . $customer_id;
		$customer_info = ExistingCustomerUpdate::Create(
			new CustomerMicrositeCustomFieldBluePrint( $customer_id, ["label" => "microsite_id", "value" => $data->user->microsite_id] )
		);

		$json_payload = json_encode( $customer_info, true );
		$data_arr = $this->request('put', $customers_url, $headr, $json_payload, true );
		$subscriptions_url = 'https://subscriptions.zoho.com/api/v1/subscriptions';
		$info = ExistingUserNewSubscription::Create(
			new MicrositeSubscriptionBluePrint($customer_id, $card_id, $plan_code)
		);

		$json_payload = json_encode( $info, true );
		$hosted_page_api = 'https://subscriptions.zoho.com/api/v1/hostedpages/newsubscription';
		$json_data = $this->request('post', $hosted_page_api, $headr, $json_payload, true );

        // return [ "success" => false , "data" => $json_data ];

		return [ "success" => true , "url" => $json_data['hostedpage']['url'] ];
	}

	public function create_aq2e_hosted_page( $headers, $api, $api_key ) {

		$data = json_decode( file_get_contents('php://input') );
		// echo json_encode($data, true); exit;
		if ( ! $data ) {
			$output = [ "success" => false, "message" => "Data invalid" ];
			return $output;
		}

		$api_url = $api;
		$headr = $headr = ZohoHeaderBuilder::build($headers);
		$check_exisitng_acct_url = 'https://subscriptions.zoho.com/api/v1/customers?email_contains='.$data->customer->email;

		$result = $this->request('get', $check_exisitng_acct_url, $headr, array() );
		$data_arr = json_decode( $result, true );
		$customers_data = $data_arr['customers'];

		if ( count($customers_data) ) {
			$customer_id = $customers_data[0]['customer_id'];
			$data->customer->customer_id = $customer_id;
		}

		$json_payload = json_encode( $data, true );
		$result = $this->request('post', $api_url, $headr, $json_payload );
		$json_data = json_decode( $result, true );

		return [ "success" => true , "url" => $json_data['hostedpage']['url'] ];
	}

	public function get_coupon() {

		$data = json_decode( file_get_contents('php://input') );

		// echo json_encode($data, true); exit;
		if ( ! $data ) {
			$output = [ "success" => false, "message" => "Data invalid" ];
			return $output;
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
					return $output;
				}
			}
		} else {
			$output = [ "success" => false, "message" =>  "invalid coupon data" ];
			return $output;
		}

		$headers = ZohoSecurityConfig::getHeaders();
		$headr = $headr = ZohoHeaderBuilder::build($headers);
		$api_url = ZohoSecurityConfig::getAPI('subscriptions', 'coupons');
		$api_url .= $billing_coupon['coupon'];

		//return [ "success" => false , "api_url" => $api_url ];

		$json_data = $this->request('get', $api_url, $headr, [], true );

		if ($json_data["code"] !== 0) {
			$output = [ "success" => false, "message" =>  "Server error. Please try again later." ];
			return $output;
		}

		// return [ "success" => false , "api_url" => $api_url, "json_data" => $json_data ];

		return [ "success" => true , "result" => $json_data, "affiliate" => $affiliate->name, "affiliate_details" => $affiliate ];
	}

	public function complete_subscription( $headers, $api_url ) {
		$result = $this->request( 'get', $api_url, $headers, [] );
		$json_data = json_decode( $result, true );

		if ( $json_data[ 'status' ] != 'success' ) {
			return [ "success" => false , "message" => $json_data[ 'message' ] ];
		}
		return $json_data[ 'data' ];
	}
}
