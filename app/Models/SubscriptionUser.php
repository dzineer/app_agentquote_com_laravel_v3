<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 26 Nov 2018 10:28:20 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SubscriptionUser
 * 
 * @property int $id
 * @property string $subscription_id
 * @property string $user_id
 * @property string $name
 * @property string $next_billing_at
 * @property string $product_id
 * @property string $interval_unit
 * @property string $plan_id
 * @property string $amount
 * @property string $currency_symbol
 * @property string $product_name
 * @property string $contactperson_id
 * @property string $auto_collect
 * @property string $sub_total
 * @property string $card_id
 * @property string $status
 * @property string $customer_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class SubscriptionUser extends Eloquent
{
	protected $table = 'subscription_user';

	protected $fillable = [
		'subscription_id',
		'user_id',
		'name',
		'next_billing_at',
		'product_id',
		'interval_unit',
		'plan_id',
		'amount',
		'currency_symbol',
		'product_name',
		'contactperson_id',
		'auto_collect',
		'sub_total',
		'card_id',
		'status',
		'customer_id'
	];
}
