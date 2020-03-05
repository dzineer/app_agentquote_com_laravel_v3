<?php

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserCustomPage
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $data
 * @property string $class
 * @property int $render
 * @property int $in_menu
 * @property string $url_path
 * @property int $active
 * @property int $status
 * @property int $locked
 *
 * @package App\Models
 */
class UserCustomPage extends Eloquent
{
	protected $fillable = [
		'id' ,
		'user_id' ,
		'data' ,
		'name' ,
		'class' ,
		'render' ,
		'in_menu' ,
		'url_path' ,
		'active',
		'name',
		'locked',
	];

	protected $table = 'user_custom_pages';
}
