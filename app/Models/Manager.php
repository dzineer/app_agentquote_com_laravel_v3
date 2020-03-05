<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
	protected $fillable = [
		'group',
		'active'
	];

	protected $hidden = [
		'id', 'created_at', 'updated_at'
	];
}
