<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 06:46:47 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class FrontendTheme
 * 
 * @property int $id
 * @property string $theme
 * @property array $css
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class FrontendTheme extends Eloquent
{
	protected $casts = [
		'css' => 'json'
	];

	protected $fillable = [
		'theme',
		'css'
	];
}
