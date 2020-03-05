<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 06:46:47 +0000.
 */

namespace Dzineer\CustomModules\Models;

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
class HashModule extends Eloquent
{
	protected $table = 'hash_modules';

	protected $with = [
		'custom_module'
	];

	protected $fillable = [
		'id',
		'module_id',
		'hash_id'
	];

	public function custom_module() {
		return $this->belongsTo(CustomModule::class, 'module_id', 'id');
	}

}
