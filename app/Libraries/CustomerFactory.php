<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-01-22
 * Time: 13:57
 */

namespace App\Libraries;

/**
 * Interface CustomerFactory
 * @package App\Libraries
 */
interface CustomerFactory {
	/**
	 * @return mixed
	 */
	function Create();
}