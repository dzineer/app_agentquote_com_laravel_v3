<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 06:58:22 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CarriersCategory
 * 
 * @property int $id
 * @property int $carrier_id
 * @property int $category_id
 *
 * @package App\Models
 */
class CarriersCategory extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'carrier_id' => 'int',
		'category_id' => 'int'
	];

	protected $fillable = [
		'carrier_id',
		'category_id'
	];
}
