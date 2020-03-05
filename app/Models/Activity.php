<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
	protected $table = 'activities';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'id',
		'user_id',
		'subject_id',
		'subject_type'
	];

/*	protected $hidden = [
		'id', 'created_at', 'updated_at'
	];*/
}
