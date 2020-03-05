<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 06:46:47 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PageModule
 *
 * @property int $id
 * @property int $page_id
 * @property int $section_id
 * @property string $data
 * @property int $status
 *
 * @package App\Models
 */
class BackupPageSection extends Eloquent
{
	protected $fillable = [
		'id' ,
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

	protected $table = 'backup_page_sections';

	protected $with = ['page'];

    public function page() {
        return $this->belongsTo(Page::class, 'page_id', 'id');
    }
}
