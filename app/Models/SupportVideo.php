<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 06:46:47 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SupportVideo
 * 
 * @property int $id
 * @property string $caption
 * @property string $url
 * @property string $image
 * @property int $preferred
 *
 * @package App\Models
 */
class SupportVideo extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
	];

	protected $fillable = [
		'caption',
		'url',
		'image',
		'preferred'
	];

}
