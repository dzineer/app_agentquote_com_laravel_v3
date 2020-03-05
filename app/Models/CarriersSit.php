<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 08:31:19 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CarriersSit
 * 
 * @property int $id
 * @property int $user_id
 * @property int $company_id
 *
 * @package App\Models
 */
class CarriersSit extends Eloquent
{
	protected $table = 'carriers_sit';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'company_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'company_id'
	];
}
