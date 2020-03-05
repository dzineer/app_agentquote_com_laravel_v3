<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 06:46:47 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Microsite
 * 
 * @property int $id
 * @property int $user_id
 * @property int $subdomain_id
 * @property int $default_category_id
 * @property int $profile_id
 * @property bool $show_logo
 * @property bool $show_portrait
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Microsite extends Eloquent
{
	protected $casts = [
		'user_id' => 'int',
		'subdomain_id' => 'int',
		'default_category_id' => 'int',
		'profile_id' => 'int',
		'show_logo' => 'bool',
		'show_portrait' => 'bool'
	];

	protected $fillable = [
		'user_id',
		'subdomain_id',
		'default_category_id',
		'profile_id',
		'show_logo',
		'show_portrait'
	];
}
