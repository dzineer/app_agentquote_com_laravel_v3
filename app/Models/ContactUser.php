<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 06:46:47 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserContact
 * 
 * @property int $id
 * @property int $user_id
 * @property string $fname
 * @property string $lname
 * @property string $email
 * @property string $addr1
 * @property string $addr2
 * @property string $city
 * @property string $state
 * @property string $zipcode
 * @property string $primary_phone
 *
 * @package App\Models
 */
class ContactUser extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'fname',
		'lname',
		'email',
		'addr1',
		'addr2',
		'city',
		'state',
		'zipcode',
		'primary_phone'
	];
}
