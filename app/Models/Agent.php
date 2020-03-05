<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
	protected $table = 'agents';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'contact_email',
		'logo',
		'portrait',
		'company',
		'contact_phone',
		'contact_addr1',
		'contact_addr2',
		'contact_city',
		'contact_state',
		'contact_zip',
		'position_title'
	];

	protected $hidden = [
		'id', 'created_at', 'updated_at'
	];
}
