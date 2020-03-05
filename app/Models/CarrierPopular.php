<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 06:46:47 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CarrierPopular
 * 
 * @property int $id
 * @property string $caption
 * @property string $url
 * @property string $image
 * @property int $preferred
 *
 * @package App\Models
 */
class CarrierPopular extends Eloquent
{
	protected $table = 'carriers_popular';
	public $timestamps = false;

	protected $casts = [
	];

	protected $fillable = [
		'company_id',
		'popular',
		'preferred'
	];

	public function company() {
		return $this->hasOne(Carrier::class, 'company_id');
	}

}
