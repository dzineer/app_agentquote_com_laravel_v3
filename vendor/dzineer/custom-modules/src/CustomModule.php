<?php

namespace Dzineer\CustomModules;

use Dzineer\CustomModules\Models\CustomModuleAdmin;
use Dzineer\CustomModules\Models\CustomModuleUser;

abstract class CustomModule implements iCustomModule {
	/**
	 * @param $module
	 * @param $data
	 *
	 * @return mixed
	 * @note: This method expects that this module is used by a user.
	 *        To change this behavior, this method must be overridden.
	 */
	public function boot( $module, $data ) {

		$userId = Auth::user()->id;

		if (CustomModuleUser::where([
			'user_id' => $userId,
			'custom_module_id' => $module->id
		])->exists()) {
			if ( ! $data['checked'] ) {
				return [ 'successful' => false, 'Module ' . $module->name . ' is already installed. Are you sure you want to overwrite?'];
			}
		}

		$config = json_decode($module->data, true);

		// dd($config);

		CustomModuleUser::updateOrCreate(
			[
				'user_id' => $userId,
				'custom_module_id' => $module->id
			],
			['data' => json_encode($config['parameters'])]
		);

	}

	/**
	 * @param $module
	 * @param $data
	 *
	 * @return mixed
	 * @note: This method expects that this module is used by a user.
	 *        To change this behavior, this method must be overridden.
	 */
	public function install( $module, $data ) {
		// TODO: Ran once to register as a installed admin module

		// dd($data);

		$userId = Auth::user()->id;

		if (CustomModuleAdmin::where([
			'user_id' => $userId,
			'custom_module_id' => $module->id
		])->exists()) {
			if ( ! $data['checked'] ) {
				return [ 'successful' => false, 'Module ' . $module->name . ' is already installed. Are you sure you want to overwrite?'];
			}
		}

		$config = json_decode($module->data, true);

		CustomModuleAdmin::updateOrCreate(
			[
				'user_id' => $userId,
				'custom_module_id' => $module->id
			],
			['data' => json_encode($config['config'])]
		);

	}

	/**
	 * @return mixed
	 * @note: methods - the web methods the custom module supports
	 *        hooks   - the hooks this custom module wants to register callbacks for.
	 */
	public function register() {
		return [ "methods" => $this->getMethods(), "hooks" => $this->getHooks() ];
	}
	/**
	 * @return mixed
	 */
	abstract public function getMethods();

	/**
	 * @return mixed
	 */
	abstract public function getHooks();
}