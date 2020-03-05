<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 06:46:47 +0000.
 */

namespace Dzineer\CustomModules\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserModuleMonitorLink
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
class UserModuleMonitorLink extends Eloquent
{
	protected $table = 'user_module_monitor_links';

	protected $fillable = [
		'id',
		'encoded_url',
		'hash_id',
	];

}
