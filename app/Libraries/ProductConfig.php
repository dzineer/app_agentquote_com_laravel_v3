<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 11/12/18
 * Time: 3:54 PM
 */

namespace App\Libraries;

class ProductConfig
{
	public static function has($product) {
		$products = config('zoho.products');
		return in_array($product, $products);
	}
}