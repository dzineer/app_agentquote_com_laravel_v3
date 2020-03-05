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
class HashCustomModuleUser extends Eloquent
{
	protected $table = 'hash_custom_module_users';

	protected $with = [
		'custom_modules_user'
	];

	protected $fillable = [
		'id',
		'custom_modules_user_id',
		'hash_id'
	];

	public function custom_modules_user() {
		return $this->belongsTo(CustomModuleUser::class, 'custom_modules_user_id', 'id');
	}

}
