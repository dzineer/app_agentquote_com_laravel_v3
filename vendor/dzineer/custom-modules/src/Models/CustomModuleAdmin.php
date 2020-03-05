<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 06:46:47 +0000.
 */

namespace Dzineer\CustomModules\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CustomModuleAdmin
 *
 * @property int $id
 * @property int $user_id
 * @property int $custom_module_id
 * @property string $data
 * @property int $status
 *
 * @package App\Models
 */
class CustomModuleAdmin extends Eloquent
{
	protected $fillable = [
		'id' ,
		'custom_module_id' ,
		'user_id' ,
		'data' ,
		'status'
	];

	protected $table = 'custom_module_admins';

	protected $with = [
		'module'
	];

	public function module() {
		return $this->belongsTo(CustomModule::class, 'custom_module_id' );
	}

}
