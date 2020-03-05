<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 9/25/18
 * Time: 8:01 PM
 */

namespace App\Libraries;
use Illuminate\Support\Facades\Validator;

class FD3Random
{
	public static function randomId($field, $t, $c, $size = 10){

		$id = str_random($size);

		$filter = 'unique:'. $t.','.$c;

		$validator = Validator::make([$field=>$id],[$field=>$filter]);

		if($validator->fails()){
			return FD3Random::randomId($field, $t, $c, $size);
		}

		return $id;
	}


}