<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 26 Nov 2018 08:41:44 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PlanSubscription
 * 
 * @property int $id
 * @property int $user_id
 * @property string $setup_fee
 * @property string $quantity
 * @property string $plan_code
 * @property string $total
 * @property string $price
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class PlanSubscription extends Eloquent
{

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'name',
		'setup_fee',
		'quantity',
		'plan_code',
		'total',
		'price'
	];
}
