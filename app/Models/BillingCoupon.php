<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingCoupon extends Model
{
	protected $table = 'billing_coupons';

	protected $fillable = [
		'id',
		'coupon',
	];

	protected $hidden = [
		'created_at', 'updated_at'
	];
}
