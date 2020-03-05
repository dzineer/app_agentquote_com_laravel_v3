<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-01-23
 * Time: 12:59
 */

namespace App\Libraries;

/**
 * Class AffiliateProgramBasicFactory
 * @package App\Libraries
 */
class AffiliateProgramBasicFactory implements AppFactory {
	/**
	 * @param AppBuilder $builder
	 *
	 * @return mixed|void
	 */
	public static function Create(AppBuilder $builder) {
		$builder->build();
	}
}