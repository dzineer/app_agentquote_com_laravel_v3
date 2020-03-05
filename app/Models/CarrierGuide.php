<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 06:46:47 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CarrierGuide
 * 
 * @property int $id
 * @property string $caption
 * @property string $url
 * @property string $image
 * @property int $preferred
 *
 * @package App\Models
 */
class CarrierGuide extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
	];

	protected $fillable = [
		'company_id',
		'name',
		'url',
		'guide_title',
		'category_id',
		'product',
		'preferred',
	];

	public function company() {
		return $this->hasOne(Carrier::class, 'company_id');
	}

	public function category() {
		return $this->hasOne(CategoriesInsurance::class, 'category_id');
	}

}
