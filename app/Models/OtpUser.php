<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 06:46:47 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class OtpUser
 * @package App\Models
 */
class OtpUser extends Eloquent
{
	/**
	 * @var string
	 */
	protected $table = 'otp_users';

	/**
	 * @var array
	 */
	protected $casts = [
		'otp' => 'string'
	];

	/**
	 * @var array
	 */
	protected $fillable = [
		'id',
		'user_id',
		'otp',
		'updated_at',
		'created_at'
	];
}
