<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 06:46:47 +0000.
 */

namespace Dzineer\CustomModules\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserModuleHashLink
 *
 * @package Dzineer\CustomModules\Models
 */
class UserModuleHashLink extends Eloquent
{
	/**
	 * @var string
	 */
	protected $table = 'user_module_hash_links';
	/**
	 * @var array
	 */
	protected $fillable = [
		'user_module_id',
		'monitor_link_id',
	];

}
