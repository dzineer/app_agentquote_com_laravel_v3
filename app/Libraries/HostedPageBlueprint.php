<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-01-25
 * Time: 12:24
 */

namespace App\Libraries;

/**
 * Interface HostedPageBlueprint
 * @package App\Libraries
 */
interface HostedPageBlueprint {
	/**
	 * @return mixed
	 */
	function build();
}