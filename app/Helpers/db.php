<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 9/25/18
 * Time: 8:19 PM
 */
use Illuminate\Support\Facades\Validator;

if (!function_exists('generateId')) {
	function generateId($field, $t, $c, $size = 10){

		$id = str_random($size);

		$filter = 'unique:'. $t.','.$c;

		$validator = Validator::make([$field=>$id],[$field=>$filter]);

		if($validator->fails()){
			return generateId($field, $t, $c, $size);
		}

		return $id;
	}
}