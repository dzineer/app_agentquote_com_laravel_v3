<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-01-23
 * Time: 12:56
 */

namespace App\Libraries;

use App\Models\Affiliate;
use App\Models\AffiliateBillingCoupon;
use App\Models\AffiliateCoupon;
use App\Models\AffiliateGroup;
use App\Models\AffiliateGroupUser;
use App\Models\InvoiceItemUser;
use App\Models\PlanSubscription;
use App\Models\InvoiceUser;
use App\Models\Profile;
use App\Models\RoleUser;
use App\Models\SubscriptionUser;
use App\User;
use Illuminate\Support\Facades\Hash;

/**
 * Class AffiliateProgramCompleteBuilder
 * @package App\Libraries
 */
class AffiliateProgramCompleteBuilder implements AppBuilder {
	/**
	 * @var
	 */
	/**
	 * @var
	 */
	/**
	 * @var
	 */
	/**
	 * @var
	 */
	/**
	 * @var
	 */
	/**
	 * @var
	 */
	private $customer, $subscription, $billing, $plan, $invoice, $fields;

    const AFFILIATE_USER = 2;
    const MY_MOBILE_LIFE_QUOTER = 1;

	/**
	 * MobileQuoterBuilder constructor.
	 *
	 * @param $customer
	 * @param $subscription
	 * @param $billing
	 * @param $plan
	 * @param $invoice
	 * @param $fields
	 */
	public function __construct($customer, $subscription, $billing, $plan, $invoice, $fields) {
		$this->customer = $customer;
		$this->subscription = $subscription;
		$this->billing = $billing;
		$this->plan = $plan;
		$this->invoice = $invoice;
		$this->fields = $fields;
	}

	/**
	 * @return mixed|void
	 */
	public function build() {
		$user = new User();
		$user->password = Hash::make($this->fields['p']);
		$user->email = $this->fields['u'];
		$user->fname = $this->customer['first_name'];
		$user->lname = $this->customer['last_name'];
		$user->name = $this->customer['display_name'];
		$user->save();

		$profile = new Profile();
		$profile->user_id = $user->id;
		$profile->contact_email = $user->email;
		$profile->company = $this->customer['company_name'];
		$profile->contact_addr1 = $this->billing['street'];
		$profile->contact_city = $this->billing['city'];
		$profile->contact_state = $this->billing['state'];
		$profile->contact_zip = $this->billing['zip'];
		$profile->save();

        $newAffiliate = Affiliate::create([
            "name" => $this->customer['company_name']
        ]);

        $affiliateCoupon = AffiliateCoupon::create([
            'affiliate_id' => $newAffiliate->id,
            "coupon" => 'CHANGE ME',
            'billing_coupon_id' => self::MY_MOBILE_LIFE_QUOTER,
        ]);

        $group = AffiliateGroup::create([
            'affiliate_id' => $newAffiliate->id,
            'name' => $this->customer['company_name'],
            'description' => $this->customer['company_name'],
        ]);

        $affgroupUser = AffiliateGroupUser::create([
            "affiliate_id" => $newAffiliate->id,
            "group_id" => $group->id,
            "user_id" => $user->id,
        ]);

        $affBBillingCoupon = AffiliateBillingCoupon::create([
            'affiliate_coupon_id' => $affiliateCoupon->id,
            'billing_coupon_id' => self::MY_MOBILE_LIFE_QUOTER,
        ]);

        $user->affiliate_id = $newAffiliate->id;
        $user->type_id = self::AFFILIATE_USER;
        $newAffiliate->user_id = $user->id;

        $user->save();
        $newAffiliate->save();

		RoleUser::updateOrCreate(
			[
				'role_id' => 2,
				'user_id' => $user->id
			]
		);

		PlanSubscription::updateOrCreate(
			[ 'user_id' => $user->id,
			  'plan_code' => $this->plan['plan_code'],
			  'name' => $this->plan['name'],
			  'quantity' => $this->plan['quantity'],
			  'price' => $this->plan['price'],
			  'discount' => $this->plan['discount'],
			  'total' => $this->plan['total'],
			  'setup_fee' => $this->plan['setup_fee'],
			  'description' => $this->plan['description'],
			  'tax_id' => $this->plan['tax_id']
			]
		);

		InvoiceUser::updateOrCreate(
			[ 'user_id' => $user->id,
			  'invoice_id' => (string) $this->invoice['invoice_id'],
			  'number' => (string) $this->invoice['number'],
			  'customer_id' => (string) $this->customer['customer_id'],
			  'status' => (string) $this->invoice['status'],
			  'currency_code' => (string) $this->invoice['currency_code'],
			  'invoice_date' => (string) $this->invoice['invoice_date'],
			  'sub_total' => (string) $this->invoice['sub_total'],
			  'total' => (string) $this->invoice['total'],
			  'customer_name' => (string) $this->invoice['customer_name'],
			  'invoice_url' => (string) $this->invoice['invoice_url'],
			]
		);

		$invoice_item = $this->invoice['invoice_items'][0];

		InvoiceItemUser::updateOrCreate(
			[ 'item_id' => $invoice_item['item_id'],
			  'invoice_id' => $this->invoice['invoice_id'],
			  'code' => (string) $invoice_item['code'],
			  'quantity' => $invoice_item['quantity'],
			  'discount_amount' => $invoice_item['discount_amount'],
			  'tax_name' => $invoice_item['tax_name'],
			  'description' => $invoice_item['description'],
			  'item_total' => $invoice_item['item_total'],
			  'tax_id' => $invoice_item['tax_id'],
			  'tax_type' => $invoice_item['tax_type'],
			  'price' => $invoice_item['price'],
			  'product_id' => $invoice_item['product_id'],
			  'account_name' => $invoice_item['account_name'],
			  'name' => $invoice_item['name'],
			  'tax_percentage' => $invoice_item['tax_percentage']
			]
		);

		SubscriptionUser::updateOrCreate(
			[
				'user_id' => $user->id,
				'subscription_id' => (string) $this->subscription['subscription_id'],
				'customer_id' => (string) $this->customer['customer_id'],
				'next_billing_at' => (string) $this->subscription['next_billing_at'],
				'product_id' => (string) $this->subscription['product_id'],
				'interval_unit' => (string) $this->subscription['interval_unit'],
				'amount' => (string) $this->subscription['amount'],
				'currency_symbol' => (string) $this->subscription['currency_symbol'],
				'product_name' => (string) $this->subscription['product_name'],
				'auto_collect' => (string) $this->subscription['auto_collect'],
				'name' => (string) $this->subscription['name'],
				'sub_total' => (string) $this->subscription['sub_total']
			]
		);
	}
}
