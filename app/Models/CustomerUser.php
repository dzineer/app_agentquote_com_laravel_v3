<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 26 Nov 2018 08:24:53 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CustomerUser
 * 
 * @property int $id
 * @property int $user_id
 * @property string $last_name
 * @property string $first_name
 * @property string $billing_address_street
 * @property string $billing_address_street2
 * @property string $billing_address_country
 * @property string $billing_address_city
 * @property string $billing_address_state
 * @property string $billing_address_zip
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class CustomerUser extends Eloquent
{
	protected $table = 'customer_user';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'last_name',
		'first_name',
		'billing_address_street',
		'billing_address_street2',
		'billing_address_country',
		'billing_address_city',
		'billing_address_state',
		'billing_address_zip'
	];
}
