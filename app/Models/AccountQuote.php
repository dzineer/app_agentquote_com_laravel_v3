<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 22 Oct 2018 17:55:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AccountQuote
 * 
 * @property int $id
 * @property string $hostname
 * @property string $endpoint
 * @property string $client_id
 * @property string $password
 * @property string $site_num
 * @property string $grant_type
 * @property string $client_secret
 *
 * @package App\Models
 */
class AccountQuote extends Eloquent
{
	protected $table = 'account_quote';
	public $timestamps = false;

	protected $hidden = [
		'password',
		//'client_secret'
	];

	protected $fillable = [
		'hostname',
		'endpoint',
		'client_id',
		'password',
		'site_num',
		'grant_type',
		'client_secret'
	];
}
