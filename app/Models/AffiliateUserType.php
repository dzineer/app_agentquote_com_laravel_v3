<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class AffiliateUserType
 *
 * @package App\Notifications
 */
class AffiliateUserType extends Eloquent
{
	protected $table = 'affiliate_user_types';

	protected $fillable = [
	    'id',
        'name'
	];
}

