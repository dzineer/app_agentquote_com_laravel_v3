<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 11/12/18
 * Time: 3:57 PM
 */

namespace App\Libraries;

use App\Models\OtpUser;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\NotAuthorizedException;

/**
 * Class OtpSecurity
 * @package App\Libraries
 */
class OtpSecurity {
	/**
	 * @param $username
	 * @param $password
	 *
	 * @return string
	 */
	public static function generate($username, $password) {
		if (Auth::attempt(array('email' => $username, 'password' => $password))){
			$otp_val = sha1(rand(1,1000).Auth::user()->id);
			$otp_user = new OtpUser();
			$otp_user->user_id = Auth::user()->id;
			$otp_user->otp = $otp_val;
			$otp_user->save();
			return $otp_user->otp;
		}
	}

    /**
     * @param $id
     * @return string
     * @throws \App\Exceptions\NotAuthorizedException
     */
    public static function generate_by_admin($id) {
        // only allow higher level user to change password
        $userToChange = User::findOrFail($id);

        if ( $userToChange->type_id > Auth::user()->type_id ) {
            throw new NotAuthorizedException("You are not authorized to reset user password.");
        }

        $otp_val = sha1(rand(1,1000).$id);
        $otp_user = new OtpUser();
        $otp_user->user_id = Auth::user()->id;
        $otp_user->otp = $otp_val;
        $otp_user->save();
        return $otp_user->otp;
    }

	/**
	 * @param $otp
	 *
	 * @return bool
	 */
	public static function auth($otp) {
		//  echo $otp; exit;
		if ($opt_user = OtpUser::where("otp", "=", $otp )->first()) {
			$user = User::find($opt_user->user_id);
			Auth::loginUsingId($user->id, true);
			$opt_user->forceDelete();
			return true;
		}
		return false;
	}

    // Function to generate OTP
    public static function generateNumericOTP($n) {

        // Take a generator string which consist of
        // all numeric digits
        $generator = "135792468";

        // Iterate for n-times and pick a single character
        // from generator and append it to $result

        // Login for generating a random character from generator
        //     ---generate a random number
        //     ---take modulus of same with length of generator (say i)
        //     ---append the character at place (i) from generator to result

        $result = "";

        for ($i = 0; $i < $n; $i++) {
            $result .= substr($generator, (rand()%(strlen($generator))), 1);
        }

        // make sure we got 5 numbers
        $result = str_pad($result, 5, "0", STR_PAD_RIGHT);

        // Return result
        return $result;
    }
}
