<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-01-23
 * Time: 12:58
 */

namespace App\Libraries;

/**
 * Interface AppFactory
 * @package App\Libraries
 */
interface AppFactory {
	/**
	 * @param AppBuilder $builder
	 *
	 * @return mixed
	 */
	static function Create(AppBuilder $builder);
}