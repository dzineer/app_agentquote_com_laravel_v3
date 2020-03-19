<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class TokenUser
 *
 * @package App\Notifications
 */
class TokenUser extends Eloquent
{
	protected $table = 'token_users';

	protected $fillable = [
	    'user_id',
        'token'
	];
}
