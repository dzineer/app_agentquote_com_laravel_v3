<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-01-23
 * Time: 12:59
 */

namespace App\Libraries;

/**
 * Class MobileQuoterFactory
 * @package App\Libraries
 */
class MobileQuoterFactory implements AppFactory {
	/**
	 * @param AppBuilder $builder
	 *
	 * @return mixed|void
	 */
	public static function Create(AppBuilder $builder) {
		$builder->build();
	}
}