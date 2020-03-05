<?php

namespace Dzineer\CustomModules\Repositories;

use Dzineer\CustomModules\Models\CustomModule;
use Dzineer\CustomModules\Models\CustomModuleAdmin;
use Dzineer\CustomModules\Models\CustomModuleUser;
use Dzineer\CustomModules\Models\ModuleType;
use Illuminate\Support\Facades\Log;

class CustomModuleRepository
{
	const SUPPORTS_ADMIN = 1;
	const SUPPORTS_USER = 1;

	/**
	 * @param $module
	 * @param $userId
	 *
	 * @return |null
	 */
	public function getAdminModule($module, $userId) {
		$mod = $this->getModule($module);
		// dnd([$mod, $userId]);
		if ($mod) {
			$customModuleAdmin = CustomModuleAdmin::where(['custom_module_id' => $mod->id, 'user_id' => $userId ]);
			// dd([$customModuleAdmin]);
			if( $customModuleAdmin->exists() ) {
				return $customModuleAdmin->first();
			}
			return null;
		}

		return null;
	}

	/**
	 * @param $module
	 *
	 * @return mixed
	 */
	public function getModule($module) {
		return CustomModule::where(['module_name' => $module])->first();
	}

	/**
	 * @param $module
	 * @param $data
	 *
	 * @return |null
	 */
	public function updateModule($module, $data) {
		$mod = CustomModule::where(['module_name' => $module])->first();

		if ($mod) {
			$mod->data = $data;
			$mod->save();
			return $mod;
		}

		return null;
	}

	/**
	 * @param $id
	 * @param $userId
	 *
	 * @return |null
	 */
	public function removeUserCustomModuleId($id, $userId) {
		$customModules = CustomModuleUser::where(['id' => $id, 'user_id'=> $userId]);
		if( $customModules->exists() ) {
			return $customModules->delete();
		}

		return null;
	}

	/**
	 * @param $id
	 * @param $userId
	 *
	 * @return |null
	 */
	public function removeAllUserModulesByCustomModuleId($id, $userId) {
		$customModules = CustomModuleUser::where(['custom_module_id' => $id]);
		if( $customModules->exists() ) {
			return $customModules->delete();
		}

		return null;
	}

	/**
	 * @param $id
	 * @param $userId
	 *
	 * @return |null
	 */
	public function getAdminModules($userId) {
		$modules = [];
		$adminCustomModulesResult = CustomModuleAdmin::where(['user_id' => $userId]);
		// dd($adminCustomModulesResult->get());
		if( $adminCustomModulesResult->exists() ) {
			$adminCustomModules = $adminCustomModulesResult->get();
			foreach ($adminCustomModules as $adminCustomModule) {
				// dnd($adminCustomModule);
				$modules[] = $adminCustomModule->module;
			}
		}

		// dd($modules);

		return $modules;
	}

	/**
	 * @param $id
	 * @param $userId
	 *
	 * @return |null
	 */
	public function getAdminModuleById($id, $userId) {
		$customModuleAdmin = CustomModuleAdmin::where(['id' => $id, 'user_id' => $userId]);
		if( $customModuleAdmin->exists() ) {
			return $customModuleAdmin->first();
		}

		return null;
	}

	/**
	 * @param $id
	 * @param $userId
	 *
	 * @return |null
	 */
	public function getUserModuleById($id, $userId) {
		$customModuleUser = CustomModuleUser::where(['id' => $id, 'user_id' => $userId]);
		// dnd(['id' => $id, 'user_id' => $userId, $customModuleUser->first()]);
		if( $customModuleUser->exists() ) {
			return $customModuleUser->first();
		}

		return null;
	}

	/**
	 * @param $module
	 * @param $userId
	 *
	 * @return |null
	 */
	public function getUserModule($module, $userId) {
		$mod = $this->getModule($module);
		// dnd([$mod, $userId]);
		if ($mod) {
			$customModuleUser = CustomModuleUser::where(['custom_module_id' => $mod->id, 'user_id' => $userId]);
			if( $customModuleUser->exists() ) {
				return $customModuleUser->first();
			}
			return null;
		}

		return null;
	}

	/**
	 * @param $userId
	 *
	 * @return mixed
	 */
	public function getModules($userId) {
		return CustomModuleAdmin::where(['user_id' => $userId])->get();
	}

	/**
	 * @param $userId
	 *
	 * @return mixed
	 */
	public function getUserModules($userId, $moduleType=null) {

		if ($moduleType) {
			// Get the Module Type
			$moduleType = ModuleType::where('type', $moduleType)->first();

			Log::info("\ngetUserModules - ModuleType: " .'module_type' . $moduleType . ' - ' . print_r($moduleType, true) . " ]");
			$customModuleUsers = [];

			// Get all Custom Modules with Module Type
			$customModules = CustomModuleUser::where( ['user_id' => $userId] )->get()->filter(function($customUserModule) use($moduleType) {
				return $customUserModule->module->module_type_id === $moduleType->id;
			});

/*			// Get all User Custom Modules within in the Custom Modules returned
			return $customModules->map(function($customUserModule) {
				$customModuleAdmin = CustomModuleAdmin::where(['custom_module_id' => $customUserModule->custom_module_id ])->first();
				$customModuleUser = new \stdClass();
				$customModuleUser->config = json_decode($customModuleAdmin['data'],true);
				$customModuleUser->parameters = json_decode($customUserModule['data'],true);
				return $customModuleUser;
			});*/

			return $customModules;

		} else {
			return CustomModuleUser::where(['user_id' => $userId])->get();
		}

	}

	/**
	 * @return \Dzineer\CustomModules\Models\CustomModule[]|\Illuminate\Database\Eloquent\Collection
	 */
	public function getAllModules() {
		return CustomModule::all();
	}

}