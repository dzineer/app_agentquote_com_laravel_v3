<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 11/12/18
 * Time: 12:45 PM
 */

namespace App\Http\Controllers;

use App\Libraries\AffiliateProgramBasicBuilder;
use App\Libraries\AffiliateProgramBasicFactory;
use App\Libraries\AffiliateProgramCompleteBuilder;
use App\Libraries\AffiliateProgramCompleteFactory;
use App\Libraries\MobileQuoterBuilder;
use App\Libraries\MobileQuoterFactory;
use App\Libraries\OtpSecurity;
use App\Libraries\ProductConfig;
use App\Libraries\ZohoProxyUpdate;
use Illuminate\Http\Request;

error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Class Subscribe
 * @package App\Http\Controllers
 */
class Subscribe {

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function affiliate(Request $request) {
		return view('subscribe.affiliate-signup-index');
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function aq2e(Request $request) {
		if ( $request->has('a') ) {
			$affiliate_id = $request->input('a');
			return view('subscribe.agent-signup-index', [ "affiliate_id" => $affiliate_id ] );
		} else {
			$affiliate_id = 'aqterm';
			return view('subscribe.agent-signup-index', [ "affiliate_id" => $affiliate_id ] );
		}

		// abort(404);
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function mmlq(Request $request) {
		return view('subscribe.index');
	}

    public function affiliate_complete(Request $request) {
        return view('subscribe.affiliate-signup-index');
    }

    public function affiliate_basic(Request $request) {
        return view('subscribe.affiliate-signup-basic-index');
    }

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function aqmeeting(Request $request) {
		return view('subscribe.aqmeeting-signup');
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function signup(Request $request) {
		if ( $request->has('p') ) {
			$product_id = $request->input('p');

			if ( ProductConfig::has( $product_id ) ) {
				switch ($product_id) {
					case 'mmlq':
						return view('subscribe.index');
					case 'affiliate':
						return view('subscribe.affiliate-signup-index');
				}
			}
		}
	}

	/**
	 * @param       $custom_fields
	 * @param array $fields
	 *
	 * @return array
	 */
	private function findFields( $custom_fields, $fields = [] ) {
		$found = [];
		foreach( $fields as $field )
		{
			foreach ($custom_fields as $f) {
				if ($field === $f['label']) {
					$found[ $field ] = $f['value_formatted'];
				}
			}
		}
		return $found;
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
	 */
	public function completed(Request $request) {

		if ( $request->has(['p', 'hostedpage_id']) ) {

			$product_id = $request->input('p');
			$hostedpage_id = $request->input('hostedpage_id');

			if ( ProductConfig::has( $product_id ) ) {
				switch ($product_id)
				{
					case 'my_mobile_life_quoter':
						// echo $hostedpage_id; exit;
						$service = new ZohoProxyUpdate();
						$response = $service->process_request( $request );
						$subscription = $response['subscription'];
						$invoice = $response['invoice'];
						$plan = $subscription['plan'];
						$customer = $response['customer'];
						$billing = $customer['billing_address'];
						$fields = $this->findFields( $customer['custom_fields'], ['affiliate_id', 'u', 'p'] );

						// echo json_encode($response, true); exit;

						MobileQuoterFactory::Create(
							new MobileQuoterBuilder($customer, $subscription, $billing, $plan, $invoice, $fields)
						);

						// echo json_encode($subscription); exit;
						// echo json_encode($customer->company_name); exit;

						$otp = OtpSecurity::generate($fields['u'], $fields['p']);
						$url = 'https://app.agentquote.com/user/otl?otp='.$otp;
						// echo $url; exit;
						return redirect()->to($url);

                    case 'affiliate_program_complete':
                        // echo $hostedpage_id; exit;
                        $service = new ZohoProxyUpdate();
                        $response = $service->process_request( $request );
                        $subscription = $response['subscription'];
                        $invoice = $response['invoice'];
                        $plan = $subscription['plan'];
                        $customer = $response['customer'];
                        $billing = $customer['billing_address'];
                        $fields = $this->findFields( $customer['custom_fields'], ['u', 'p'] );

                        // echo json_encode($response, true); exit;

                        AffiliateProgramCompleteFactory::Create(
                            new AffiliateProgramCompleteBuilder($customer, $subscription, $billing, $plan, $invoice, $fields)
                        );

                        // echo json_encode($subscription); exit;
                        // echo json_encode($customer->company_name); exit;

                        $otp = OtpSecurity::generate($fields['u'], $fields['p']);
                        $url = 'https://app.agentquote.com/user/otl?otp='.$otp;
                        // echo $url; exit;
                        return redirect()->to($url);

                        return response()->json([
                            "success" => true,
                            "subscription" => $subscription,
                            "plan" => $plan,
                            "invoice" => $invoice,
                            "customer" => $customer,
                            "billing" => $billing,
                            "fields" => $fields
                        ]);

                    case 'affiliate_program_basic':
                        // echo $hostedpage_id; exit;
                        // echo json_encode($response, true); exit;

                        $fields = [];

                        AffiliateProgramBasicFactory::Create(
                            new AffiliateProgramBasicBuilder($fields)
                        );

                        // echo json_encode($subscription); exit;
                        // echo json_encode($customer->company_name); exit;

                        $otp = OtpSecurity::generate($fields['u'], $fields['p']);
                        $url = 'https://app.agentquote.com/user/otl?otp='.$otp;
                        // echo $url; exit;
                        return redirect()->to($url);

                        return response()->json([
                            "success" => true,
                            "subscription" => $subscription,
                            "plan" => $plan,
                            "invoice" => $invoice,
                            "customer" => $customer,
                            "billing" => $billing,
                            "fields" => $fields
                        ]);


                }
			}
		}
	}
}
