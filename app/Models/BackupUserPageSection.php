<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 06:46:47 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class BackupUserPageSection
 *
 * @property int $id
 * @property int $page_id
 * @property int $section_id
 * @property string $data
 * @property int $status
 *
 * @package App\Models
 */
class BackupUserPageSection extends Eloquent
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
		'active' ,
		'in_menu' ,
		'version' ,
		'position'
	];

	protected $table = 'backup_user_page_sections';

	protected $with = ['page'];

    public function page() {
        return $this->belongsTo(UserPage::class, 'page_id', 'id');
    }
}
