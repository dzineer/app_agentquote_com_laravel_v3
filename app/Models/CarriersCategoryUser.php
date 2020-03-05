<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 22 Oct 2018 13:35:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CarriersCategoryUser
 * 
 * @property int $category_id
 * @property int $user_id
 * @property int $company_id
 *
 * @package App\Models
 */
class CarriersCategoryUser extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'category_id' => 'int',
		'user_id' => 'int',
		'company_id' => 'int'
	];

	protected $fillable = [
		'category_id',
		'user_id',
		'company_id'
	];
}
