<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-01-25
 * Time: 12:20
 */

namespace App\Libraries;

/**
 * Interface RequestBlueprint
 * @package App\Libraries
 */
interface ResponseBlueprint {
	/**
	 * @return mixed
	 */
	function build();
}