<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-02-25
 * Time: 16:04
 */

namespace App\Blueprints;

/**
 * Class CarrierBlueprint
 * @package App\Blueprints
 */
class CarrierBlueprint implements DZBlueprint {

	/**
	 * @var
	 */
	private $name;
	/**
	 * @var
	 */
	private $categories;

	/**
	 * CarrierBlueprint constructor.
	 *
	 * @param $name
	 * @param $categories
	 */
	public function __construct($name, $categories) {
		$this->name = $name;
		$this->categories = $categories;
	}

	/**
	 * @return \stdClass
	 */
	public function build() {
		$obj = new \stdClass();
		$obj->name = $this->name;
		$obj->categories = $this->categories;
		return $obj;
	}

}