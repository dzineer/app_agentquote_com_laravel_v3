<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliateCoupon extends Model
{
	protected $table = 'affiliate_coupon';

	protected $fillable = [
		'affiliate_id',
		'coupon',
		'billing_coupon_id',
	];
}
