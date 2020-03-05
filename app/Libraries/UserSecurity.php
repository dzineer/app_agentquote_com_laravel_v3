<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 11/12/18
 * Time: 3:57 PM
 */

namespace App\Libraries;

use Illuminate\Support\Facades\Auth;

/**
 * Class UserSecurity
 * @package App\Libraries
 */
class UserSecurity {
	/**
	 * @param $username
	 * @param $password
	 *
	 * @return bool
	 */
	public static function auth($username, $password) {
		return Auth::attempt(array('email' => $username, 'password' => $password));
	}
}