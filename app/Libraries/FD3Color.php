<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 9/20/18
 * Time: 1:59 PM
 */

namespace App\Libraries;

class FD3Color
{
	public static function rbga($color) {
		return  "rgba($color->r, $color->g, $color->b, $color->a)";
	}
}