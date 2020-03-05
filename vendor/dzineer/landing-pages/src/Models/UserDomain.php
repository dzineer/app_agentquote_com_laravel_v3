<?php

namespace Dzineer\LandingPages\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserDomain
 *
 * @package Dzineer\LandingPages\Models
 */
class UserDomain extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'user_domains';
	/**
	 * @var array
	 */
	protected $fillable = [
		'id' ,
		'user_id' ,
		'domain' ,
		'status'
	];

}

