<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-03-05
 * Time: 17:09
 */

namespace App\Subscriptions;

use App\Models\PlanSubscription;
use App\Models\Profile;
use App\Models\RoleUser;
use App\Models\SubscriptionUser;
use App\User;
use Illuminate\Support\Facades\Hash;

class MobileQuoterSubscription extends ZohoSubscriptions {
	private $user;
	private $subscription_user;
	private $plan_subscription;
	private $profile;
	private $givenState;
	private $role_user;

	/**
	 * @param $event
	 * @param $post_data
	 */
	public function subscribe(): void {
		$this->setUp();

		$this->addUser();
		$this->addProfile();
		$this->assignUserAProfile();
		$this->assignUserRole();
		$this->addPlan();
		/*
							$invoice_user = InvoiceUser::updateOrCreate(
								['user_id'       => $this->user->id,
								 'invoice_id'    => (string) $invoice['invoice_id'],
								 'number'        => (string) $invoice['number'],
								 'customer_id'   => (string) $this->customer['customer_id'],
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

		$this->createUserSubscription();
	}

	protected function addUser(): void {
		$this->user           = new User();
		$this->user->password = Hash::make($this->fields['p']);
		$this->user->email    = $this->fields['u'];
		$this->user->fname    = $this->customer['first_name'];
		$this->user->lname    = $this->customer['last_name'];
		$this->user->name     = $this->customer['display_name'];
		$this->user->save();
	}

	protected function addProfile(): void {
		$this->profile                = new Profile();
		$this->profile->user_id       = $this->user->id;
		$this->profile->contact_email = $this->user->email;
		$this->profile->company       = $this->customer['company_name'];
		$this->profile->contact_addr1 = $this->billing['street'];
		$this->profile->contact_city  = $this->billing['city'];

		$this->givenState = $this->getCorrectState($this->billing['state']);

		$this->profile->contact_state = $this->givenState;
		$this->profile->contact_zip   = $this->billing['zip'];
		$this->profile->save();
	}

	protected function assignUserRole(): void {
		$this->role_user = RoleUser::updateOrCreate(
			[
				'role_id' => 4,
				'user_id' => $this->user->id
			]
		);
	}

	protected function assignUserAProfile(): void {
		$this->user->profile_id = $this->profile->id;
		$this->user->save();
	}

	protected function addPlan(): void {
		$this->plan_subscription = PlanSubscription::updateOrCreate(
			['user_id'     => $this->user->id,
			 'plan_code'   => $this->plan['plan_code'],
			 'name'        => $this->plan['name'],
			 'quantity'    => $this->plan['quantity'],
			 'price'       => $this->plan['price'],
			 'discount'    => $this->plan['discount'],
			 'total'       => $this->plan['total'],
			 'setup_fee'   => $this->plan['setup_fee'],
			 'description' => $this->plan['description'],
			 'tax_id'      => $this->plan['tax_id']
			]
		);
	}

	protected function createUserSubscription(): void {
		$this->subscription_user = SubscriptionUser::updateOrCreate(
			[
				'user_id'         => $this->user->id,
				'subscription_id' => (string) $this->subscription['subscription_id'],
				'customer_id'     => (string) $this->customer['customer_id'],
				'next_billing_at' => (string) $this->subscription['next_billing_at'],
				'product_id'      => (string) $this->subscription['product_id'],
				'interval_unit'   => (string) $this->subscription['interval_unit'],
				'amount'          => (string) $this->subscription['amount'],
				'currency_symbol' => (string) $this->subscription['currency_symbol'],
				'product_name'    => (string) $this->subscription['product_name'],
				'auto_collect'    => (string) $this->subscription['auto_collect'],
				'name'            => (string) $this->subscription['name'],
				'sub_total'       => (string) $this->subscription['sub_total']
			]
		);
	}
}