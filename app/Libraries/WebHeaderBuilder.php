<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-01-22
 * Time: 14:32
 */

namespace App\Libraries;

/**
 * Interface WebHeaderBuilder
 * @package App\Libraries
 */
interface WebHeaderBuilder {
	/**
	 * @param $arr
	 *
	 * @return mixed
	 */
	static function build($arr);
}