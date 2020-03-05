<?php

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class BackupUserCustomPage
 *
 * @property int $id
 * @property int $user_id
 * @property int $page_id
 * @property string $name
 * @property int $render
 * @property string $data
 * @property string $class
 * @property string $base_class
 * @property int $active
 * @property int $version
 * @property string $url_path
 * @property int $locked
 *
 * @package App\Models
 */
class BackupUserCustomPage extends Eloquent
{
	protected $fillable = [
		'id' ,
		'page_id',
		'user_id',
		'data',
		'class',
		'active',
		'render',
		'url_path',
		'in_menu',
		'version',
		'locked',
	];

	protected $table = 'backup_user_custom_pages';

}
