<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-01-23
 * Time: 12:57
 */

namespace App\Libraries;

/**
 * Interface AppBuilder
 * @package App\Libraries
 */
interface AppBuilder {
	/**
	 * @return mixed
	 */
	public function build();
}