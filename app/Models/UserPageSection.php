<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 06:46:47 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserPageSection
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
class UserPageSection extends Eloquent
{
	protected $fillable = [
		'id' ,
		'user_id' ,
		'page_id' ,
		'section_id' ,
		'section' ,
		'data' ,
		'class' ,
		'render' ,
		'in_menu' ,
		'active' ,
		'position'
	];

	protected $table = 'user_page_sections';

	protected $with = ['page'];

    public function page() {
        return $this->belongsTo(UserPage::class, 'page_id', 'id');
    }
}
