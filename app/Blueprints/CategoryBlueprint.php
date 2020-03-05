<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-02-25
 * Time: 16:04
 */

namespace App\Blueprints;


/**
 * Class CategoryBlueprint
 * @package App\Blueprints
 */
class CategoryBlueprint implements DZBlueprint {

	/**
	 * @var
	 */
	private $name;
	/**
	 * @var
	 */
	private $guides;


	/**
	 * CategoryBlueprint constructor.
	 *
	 * @param $name
	 * @param $guides
	 */
	public function __construct($name, $guides) {
		$this->name = $name;
		$this->guides = $guides;
	}

	/**
	 * @return \stdClass
	 */
	public function build() {
		$obj = new \stdClass();
		$obj->name = $this->name;
		$obj->guides = $this->guides;
		return $obj;
	}

}