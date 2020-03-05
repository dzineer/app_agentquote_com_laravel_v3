<?php

namespace Dzineer\CustomModules\Library;

/**
 * Class ModuleMediator
 *
 * @package Dzineer\CustomModules\Library
 */
abstract class ModuleMediator {
	/**
	 * @var array
	 */
	protected $events = array();

	/**
	 * @param $hook
	 * @param $moduleName
	 * @param $instance
	 * @param $callback
	 */
	public function attach($hook, $moduleName, $instance, $callback) {
		//dnd($this->events);
		if( !isset($this->events[$hook]) ) {
			$this->events[$hook] = [];
		}
		if( !isset($this->events[$hook][$moduleName]) ) {
			$this->events[$hook][$moduleName] = [];
		}
		$this->events[$hook][$moduleName] = [ "instance" => $instance, "callback" => $callback ];
		//dnd($this->events);
	}

	/**
	 * @param $hook
	 * @param $moduleName
	 * @param $module
	 * @param null $data
	 *
	 * @return mixed|null
	 */
	public function trigger($hook, $moduleName, $module, $data = null) {

		// dd(["trigger", $hook, $moduleName, $module, $data]);
		// dnd([$this->events, $this->events[$hook], $this->events[$hook][$moduleName], $this->events[$hook][$moduleName]["callback"] ]);

		if ( isset($this->events[$hook]) &&
		     isset($this->events[$hook][$moduleName]) ) {
				return call_user_func(
					[ $this->events[$hook][$moduleName]["instance"], $this->events[$hook][$moduleName]["callback"] ]
					, $module, $data
				);
		}

		return null;
	}
}