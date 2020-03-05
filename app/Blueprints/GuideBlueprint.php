<?php
/**
 * Created by PhpStorm.
 * User: niran
 * Date: 2019-02-25
 * Time: 16:04
 */

namespace App\Blueprints;


/**
 * Class GuideBlueprint
 * @package App\Blueprints
 */
class GuideBlueprint implements DZBlueprint {

	/**
	 * @var
	 */
	private $name;
	/**
	 * @var
	 */
	private $url;

	/**
	 * GuideBlueprint constructor.
	 *
	 * @param $name
	 * @param $url
	 */
	public function __construct($name, $url) {
		$this->name = $name;
		$this->url = $url;
	}

	/**
	 * @return \stdClass
	 */
	public function build() {
		$obj = new \stdClass();
		$obj->name = $this->name;
		$obj->url = $this->url;
		return $obj;
	}

}