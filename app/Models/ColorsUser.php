<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColorsUser extends Model
{
	protected $table = 'user_colors';

	protected $fillable = [
		'user_id', 'menu_bar', 'rates_background', 'banner_form_background'
	];
}
