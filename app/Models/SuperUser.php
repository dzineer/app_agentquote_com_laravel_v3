<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuperUser extends Model
{
	protected $table = 'user_super';

	protected $fillable = [
		'active'
	];

	protected $hidden = [
		'id', 'created_at', 'updated_at'
	];
}
