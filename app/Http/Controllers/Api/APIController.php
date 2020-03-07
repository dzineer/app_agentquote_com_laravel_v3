<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 11/12/18
 * Time: 12:45 PM
 */

namespace App\Http\Controllers\Api;

use App\Helpers\AddresHelper;
use App\Libraries\ProductConfig;
use App\Libraries\ZohoProxyUpdate;
use App\Models\InvoiceItemUser;
use App\Models\PlanSubscription;
use App\Models\InvoiceUser;
use App\Models\Profile;
use App\Models\RoleUser;
use App\Models\WhmcsProduct;
use App\Models\Subscription;
use App\Models\LandingPageUser;
use App\Models\SubscriptionUser;
use App\Subscriptions\SubscriptionFields;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Facades\AQLog;
use App\Subscriptions\SubscriptionsDispatcher;

error_reporting(E_ALL);
ini_set('display_errors', 1);

class APIController extends Controller {

    private function isAllowed() {
        return true;
        return '140.82.47.226' === request()->ip();
    }

	public function index(Request $request) {
        
        $data = $this->validate($request, [
            'token' => 'required|max:32',
            'username' => 'required:max:32',
        ]);

        if ($data['token'] !== 'BD9AFD1F5B993E63FE2DAEE58E66C' && $data['username'] !== 'quotedirect_api') {
            return response()->json([
                "message" => "Invalid Request",
                "data" => request()->all(),
                "success" => false,
            ]);
        }

        return response()->json([
            "message" => "We we received your message",
            "data" => request()->all(),
            "token" => $data['token'],
            "username" => $data['username'],
            "mode" => "debug",
            "ok" => true, 
            "success" => true,
        ]);
    }
	public function assignUserProduct(Request $request) {
        
       // return "hey";

        if (!$this->isAllowed()) {

            Log::info( json_encode([
                "message" => "Invalid IP Address",
                "data" => request()->all(),
                "mode" => "debug",
                "ip" => request()->ip(),
                "ok" => false,                 
                "success" => false,
            ]) );

            return response()->json([
                "message" => "Invalid IP Address",
                "data" => request()->all(),
                "mode" => "debug",
                "ip" => request()->ip(),
                "ok" => false,                 
                "success" => false,
            ]);
        }

        AQLog::info( json_encode([
            "data" => request()->all(),
        ]) );

        Log::info(json_encode([
            "data" => request()->all(),
        ]));

        $data = $this->validate($request, [
            'token' => 'required|max:32',
            'username' => 'required:max:32',
        //    'product_id' => 'required:max:32',
        //    'user_id' => 'required:max:32',
        ]);

        if ($data['token'] !== 'BD9AFD1F5B993E63FE2DAEE58E66C' && $data['username'] !== 'quotedirect_api') {
            return response()->json([
                "message" => "Invalid Request",
                "data" => request()->all(),
                "success" => false,
            ]);
        }

        if($request->has('whmcs_product_name') && $request->has('whmcs_userid') && $request->has('whmcs_email') ) {

            AQLog::info( json_encode([
                "message" => "Inside request->has",
            ]) );

            $email = $request->input('whmcs_email');
            $whmcs = $request->input('whmcs_userid');
            $whmcsProductName = $request->input('whmcs_product_name');
            
            $user = User::where(['email' => $email])->first();
            
            if ($user) {

                AQLog::info( json_encode([
                    "message" => "Got User",
                    "data" => $user
                ]) );

                $whmcsLocalProduct = WhmcsProduct::where(["name" => $whmcsProductName])->first();
                if ($whmcsLocalProduct) {

                    AQLog::info( json_encode([
                        "message" => "Got WHMCS Product",
                        "data" => $whmcsLocalProduct
                    ]) );

                    $productId = $whmcsLocalProduct->local_product_id;
                    $userSubscription = Subscription::where(["user_id" => $user->id, "product_id" => $productId])->first();
                    if ($userSubscription) {

                        AQLog::info( print_r([
                            "message" => "User already has subscription",
                            "data" => $userSubscription
                        ], true) );

                        return response()->json([
                            "message" => "User already has product",
                            "data" => request()->all(),
                            "user" => $user,
                            "userSubscription" => $userSubscription,
                            "success" => false,
                        ]);
                    } else {
                        $subscription = Subscription::create([
                            "user_id" => $user->id,
                            "product_id" => $productId
                        ]);

                        LandingPageUser::create([
                            "user_id" => $user->id
                        ]);

                        AQLog::info( json_encode([
                            "message" => "Adding user to subscription",
                            "data" => $subscription 
                        ]) );

                        AQLog::info( json_encode([
                            "message" => "Product " . $whmcsLocalProduct . " added to " . $user->email . " user.",
                            "mode" => "debug",
                            "ip" => request()->ip(),
                            "ok" => true, 
                            "success" => true,
                        ]) );

                        return response()->json([
                            "message" => "Product " . $whmcsLocalProduct . " added to " . $user->email . " user.",
                            "mode" => "debug",
                            "user" => $user,
                            "subscription" => $subscription, 
                            "ip" => request()->ip(),
                            "ok" => true, 
                            "success" => true,
                        ]);

                    }
                }

            } else {
                return response()->json([
                    "message" => "Invalid user",
                    "data" => request()->all(),
                    "success" => false,
                ]);

                AQLog::info( json_encode([
                    "message" => "Invalid user",
                    "data" => request()->all(),
                    "success" => false,
                ]) );
            }
        }

        $message = "Assigning ppegram to product xyz.";

        return response()->json([
            "message" => $message,
            "data" => request()->all(),
            "token" => $data['token'],
            "username" => $data['username'],
           // "user_id" => $data['user_id'],
           // "product_id" => $data['product_id'],           
            "mode" => "debug",
            "ip" => request()->ip(),
            "ok" => true, 
            "success" => true,
        ]);
    }

	public function removeUserProduct(Request $request) {
        
        // return "hey";
 
         if (!$this->isAllowed()) {
 
             Log::info( json_encode([
                 "message" => "Invalid IP Address",
                 "data" => request()->all(),
                 "mode" => "debug",
                 "ip" => request()->ip(),
                 "ok" => false,                 
                 "success" => false,
             ]) );
 
             return response()->json([
                 "message" => "Invalid IP Address",
                 "data" => request()->all(),
                 "mode" => "debug",
                 "ip" => request()->ip(),
                 "ok" => false,                 
                 "success" => false,
             ]);
         }
 
         AQLog::info( json_encode([
             "data" => request()->all(),
         ]) );
 
         Log::info(json_encode([
             "data" => request()->all(),
         ]));
 
         $data = $this->validate($request, [
             'token' => 'required|max:32',
             'username' => 'required:max:32',
         //    'product_id' => 'required:max:32',
         //    'user_id' => 'required:max:32',
         ]);
 
         if ($data['token'] !== 'BD9AFD1F5B993E63FE2DAEE58E66C' && $data['username'] !== 'quotedirect_api') {
             return response()->json([
                 "message" => "Invalid Request",
                 "data" => request()->all(),
                 "success" => false,
             ]);
         }
 
         if($request->has('whmcs_product_name') && $request->has('whmcs_userid') && $request->has('whmcs_email') ) {
 
             AQLog::info( json_encode([
                 "message" => "Inside request->has",
             ]) );
 
             $email = $request->input('whmcs_email');
             $whmcs = $request->input('whmcs_userid');
             $whmcsProductName = $request->input('whmcs_product_name');
             
             $user = User::where(['email' => $email])->first();
             
             if ($user) {
 
                 AQLog::info( json_encode([
                     "message" => "Got User",
                     "data" => $user
                 ]) );
 
                 $whmcsLocalProduct = WhmcsProduct::where(["name" => $whmcsProductName])->first();
                 if ($whmcsLocalProduct) {
 
                     AQLog::info( json_encode([
                         "message" => "Got WHMCS Product",
                         "data" => $whmcsLocalProduct
                     ]) );
 
                     $productId = $whmcsLocalProduct->local_product_id;
                     $userSubscription = Subscription::where(["user_id" => $user->id, "product_id" => $productId])->first();
                     if ($userSubscription) {
 
                         AQLog::info( print_r([
                             "message" => "User has subscription",
                             "data" => $userSubscription
                         ], true) );
 
                         Subscription::where([
                            "user_id" => $user->id,
                            "product_id" => $productId
                        ])->delete();

                        LandingPageUser::where([
                            "user_id" => $user->id
                        ])->delete();
                         
                     } else {
                        AQLog::info( print_r([
                            "message" => "User does not have product",
                        ], true) );

                        return response()->json([
                            "message" => "User does not have product",
                            "data" => request()->all(),
                            "user" => $user,
                            "success" => false,
                        ]);
 
                     }
                 }
 
             } else {
                 return response()->json([
                     "message" => "Invalid user",
                     "data" => request()->all(),
                     "success" => false,
                 ]);
 
                 AQLog::info( json_encode([
                     "message" => "Invalid user",
                     "data" => request()->all(),
                     "success" => false,
                 ]) );
             }
         }
 
         $message = "Removing product xyz from user ppegram.";
 
         return response()->json([
             "message" => $message,
             "data" => request()->all(),
             "token" => $data['token'],
             "username" => $data['username'],
            // "user_id" => $data['user_id'],
            // "product_id" => $data['product_id'],           
             "mode" => "debug",
             "ip" => request()->ip(),
             "ok" => true, 
             "success" => true,
         ]);
     }

    /**
     * @return mixed
     */
    private function getPostData() {

		$post_data = json_decode(
		    file_get_contents('php://input'),
            true
        );

		return $post_data;
	}

    /**
     * @param \App\User $user
     * @param $plan
     * @return PlanSubscription
     */
    private function addPlanSubscriber(User $user, $plan):PlanSubscription
    {
        return PlanSubscription::updateOrCreate([
                'user_id' => $user->id,
                'plan_code' => $plan['plan_code'],
                'name' => $plan['name'],
                'quantity' => $plan['quantity'],
                'price' => $plan['price'],
                'discount' => $plan['discount'],
                'total' => $plan['total'],
                'setup_fee' => $plan['setup_fee'],
                'description' => $plan['description'],
                'tax_id' => $plan['tax_id']
            ]);
    }

    /**
     * @param array $fields
     * @param $customer
     * @return \App\User
     */
    private function newUser(array $fields, $customer): User
    {
        return User::create([
            'password' => Hash::make($fields['p']),
            'email' =>  $fields['u'],
            'fname' => $customer['first_name'],
            'lname' => $customer['last_name'],
            'name' => $customer['name']
        ]);
    }

    /**
     * @param \App\User $user
     * @param $subscription
     * @param $customer
     * @return \App\Models\SubscriptionUser
     */
    private function addSubscriber(User $user, $subscription, $customer): SubscriptionUser
    {
        return SubscriptionUser::updateOrCreate([
                'user_id' => $user->id,
                'subscription_id' => (string) $subscription['subscription_id'],
                'customer_id' => (string) $customer['customer_id'],
                'next_billing_at' => (string) $subscription['next_billing_at'],
                'product_id' => (string) $subscription['product_id'],
                'interval_unit' => (string) $subscription['interval_unit'],
                'amount' => (string) $subscription['amount'],
                'currency_symbol' => (string) $subscription['currency_symbol'],
                'product_name' => (string) $subscription['product_name'],
                'auto_collect' => (string) $subscription['auto_collect'],
                'name' => (string) $subscription['name'],
                'sub_total' => (string) $subscription['sub_total']
            ]);
    }

    /**
     * @param \App\User $user
     * @param $customer
     * @param $billing
     * @return \App\Models\Profile
     */
    private function assignUserProfile(User $user, $customer, $billing): Profile
    {
        $profileUser = Profile::create([
            'user_id' => $user->id,
            'contact_email' => $user->email,
            'company' => $customer['company_name'],
            'contact_addr1' => $billing['street'],
            'contact_city' => $billing['city']
        ]);

        $user->profile_id = $profileUser->id;
        $user->save();

        return $profileUser;
    }

    /**
     * @param \App\User $user
     * @return \App\Models\RoleUser
     */
    private function assignUserRole(User $user): RoleUser
    {
        return RoleUser::updateOrCreate([
            'role_id' => 4,
            'user_id' => $user->id
        ]);
    }

    /**
     * @param $billing
     * @param \App\Models\Profile $profile
     */
    private function updateProfileState($billing, Profile $profile): void
    {
        $givenState = AddresHelper::getCorrectState($billing['state']);

        $profile->contact_state = $givenState;
        $profile->contact_zip = $billing['zip'];
        $profile->save();
    }

    /**
     * @param $post_data
     * @return array
     */
    private function getSubscriptionItems($post_data): array
    {
        $data = $post_data['data'];
        $subscription = $data['subscription'];
        // $invoice = $response['invoice'];
        $plan = $subscription['plan'];
        $customer = $subscription['customer'];
        $billing = $customer['billing_address'];

        return [$subscription, $plan, $customer, $billing];
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    private function getRequestedItems(Request $request): array
    {
        $event = $request->input('event');
        $s = $request->input('s');
        $method = $request->input('method');
        $post_data = $this->getPostData();

        return [$event, $method, $post_data];
    }

    /**
     * @param $post_data
     */
    private function completeSubscription($post_data): void
    {
// echo $hostedpage_id; exit;
        // $service      = new ZohoProxyUpdate();
        // $response     = $service->process_request($request);
        list($subscription, $plan, $customer, $billing) = $this->getSubscriptionItems($post_data);

        $fields = SubscriptionFields::findFields($customer['custom_fields'], ['u', 'p']);
        // echo json_encode($subscription); exit;
        // echo json_encode($customer->company_name); exit;
        $user = $this->newUser($fields, $customer);
        $profile = $this->assignUserProfile($user, $customer, $billing);
        $this->updateProfileState($billing, $profile);

        $this->assignUserRole($user);

        $this->addPlanSubscriber($user, $plan);
        /*
                            $invoice_user = InvoiceUser::updateOrCreate(
                                ['user_id'       => $user->id,
                                 'invoice_id'    => (string) $invoice['invoice_id'],
                                 'number'        => (string) $invoice['number'],
                                 'customer_id'   => (string) $customer['customer_id'],
                                 'status'        => (string) $invoice['status'],
                                 'currency_code' => (string) $invoice['currency_code'],
                                 'invoice_date'  => (string) $invoice['invoice_date'],
                                 'sub_total'     => (string) $invoice['sub_total'],
                                 'total'         => (string) $invoice['total'],
                                 'customer_name' => (string) $invoice['customer_name'],
                                 'invoice_url'   => (string) $invoice['invoice_url'],
                                ]
                            );
        */

        /*					$invoice_item = $invoice['invoice_items'][0];

                            $invoice_item_user = InvoiceItemUser::updateOrCreate(
                                ['item_id'         => $invoice_item['item_id'],
                                 'invoice_id'      => $invoice['invoice_id'],
                                 'code'            => (string) $invoice_item['code'],
                                 'quantity'        => $invoice_item['quantity'],
                                 'discount_amount' => $invoice_item['discount_amount'],
                                 'tax_name'        => $invoice_item['tax_name'],
                                 'description'     => $invoice_item['description'],
                                 'item_total'      => $invoice_item['item_total'],
                                 'tax_id'          => $invoice_item['tax_id'],
                                 'tax_type'        => $invoice_item['tax_type'],
                                 'price'           => $invoice_item['price'],
                                 'product_id'      => $invoice_item['product_id'],
                                 'account_name'    => $invoice_item['account_name'],
                                 'name'            => $invoice_item['name'],
                                 'tax_percentage'  => $invoice_item['tax_percentage']
                                ]
                            );
        */

        $this->addSubscriber($user, $subscription, $customer);
    }

    /**
     * @param \Illuminate\Http\Request $request
     */
    private function dispatchRequest(Request $request): void
    {
        list($event, $method, $post_data) = $this->getRequestedItems($request);
        // echo print_r($post_data['data'], true); exit;
        // $data = $post_data['data'];
        // echo print_r(["event" => $event, "source" => $s, "method" => $method, "POST" => $_POST, "data" => $data], true); exit;

        // Log::debug( print_r(["event" => $event, "source" => $s, "method" => $method, "POST" => $_POST, "data" => $data], true) );
        // exit;

        switch ($method) {
            case 'subscription':
                if ($event === 'completed') {
                    $this->completeSubscription($post_data);
                }
                break;
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    private function getTheNewWayRequestedItems(Request $request): array
    {
        $event = $request->input('event');
        $s = $request->input('s');
        $method = $request->input('method');
        $product = $request->input('p');
        $post_data = $this->getPostData();

        return [$event, $method, $product, $post_data];
    }

    /**
     * @param \Illuminate\Http\Request $request
     */
    private function dispatchNewWayRequest(Request $request): void
    {
        list($event, $method, $product, $post_data) = $this->getTheNewWayRequestedItems($request);

        switch ($method) {
            case 'subscription':
                (new SubscriptionsDispatcher)->dispatch($product, $event, $post_data);
                break;
        }
    }
}
