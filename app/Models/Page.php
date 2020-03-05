<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 06:46:47 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Page
 *
 * @property int $id
 * @property int $page_id
 * @property int $section_id
 * @property string $data
 * @property int $status
 *
 * @package App\Models
 */
class Page extends Eloquent
{
	protected $fillable = [
		'id' ,
		'name' ,
		'status'
	];

	protected $table = 'pages';

	public function sections() {
        return $this->hasMany(PageSection::class, 'id', 'page_id');
    }
}
