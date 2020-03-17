<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class AffiliatesUser
 *
 * @package App\Notifications
 */
class AffiliatesUser extends Eloquent
{
	protected $table = 'affiliates_users';

	protected $fillable = [
        'id' ,
        'user_id',
        'affiliate_id' ,
        'affiliate_type_id'
	];
}

