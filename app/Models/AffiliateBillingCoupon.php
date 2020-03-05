<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliateBillingCoupon extends Model
{
	protected $table = 'affiliate_billing_coupon';

	protected $fillable = [
		'affiliate_coupon_id',
		'billing_coupon_id',
	];

	protected $hidden = [
		'created_at', 'updated_at'
	];
}
