<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 06:46:47 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserPage
 *
 * @property int $id
 * @property int $user_id
 * @property int $page_id
 * @property int $section_id
 * @property string $data
 * @property int $status
 *
 * @package App\Models
 */
class UserPage extends Eloquent
{
	protected $fillable = [
		'id' ,
		'user_id' ,
		'name' ,
		'status'
	];

	protected $table = 'user_pages';

	public function sections() {
        return $this->hasMany(UserPageSection::class, 'id', 'page_id');
    }
}
