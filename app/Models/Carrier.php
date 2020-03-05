<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 06:46:47 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Carrier
 * 
 * @property int $id
 * @property int $companyId
 * @property string $name
 * @property string $link1
 * @property string $link2
 * @property int $active
 *
 * @package App\Models
 */
class Carrier extends Eloquent
{
	protected $table = 'carriers';
	public $timestamps = false;

	protected $casts = [
		'company_id' => 'int',
		'active' => 'int'
	];

	protected $fillable = [
		'company_id',
		'name',
		'link1',
		'link2',
		'active'
	];

	public function categories() {
		return $this->hasMany(CarriersCategory::class);
	}

}
