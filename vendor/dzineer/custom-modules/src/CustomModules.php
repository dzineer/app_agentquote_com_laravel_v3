<?php

namespace Dzineer\CustomModules;

use Dzineer\CustomModules\Library\ModuleMediator;
use Dzineer\CustomModules\Models\CustomModuleAdmin;
use Dzineer\CustomModules\Models\CustomModuleUser;
use Dzineer\CustomModules\Repositories\CustomModuleRepository;
use Dzineer\CustomModules\Repositories\UserDomainRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Dzineer\CustomModules\Models\CustomModule as Module;

/**
 * Class CustomModules
 *
 * @package Dzineer\CustomModules
 */
class CustomModules {

	const SUPPORTS_ADMIN = 1;
	const SUPPORTS_USER = 1;

	private $_modules;
	private $_httpMethods;
	private $_registered_methods;
	private $_mediator;
	private $_modules_repository;
	private $_user_domains_repository;

	/**
	 * CustomModules constructor.
	 *
	 * @param \Dzineer\CustomModules\Library\ModuleMediator $mediator
	 * @param \Dzineer\CustomModules\Repositories\CustomModuleRepository $user_modules_repository
	 * @param \Dzineer\CustomModules\Repositories\UserDomainRepository $user_domains_repository
	 */
	public function __construct(ModuleMediator $mediator, CustomModuleRepository $user_modules_repository, UserDomainRepository $user_domains_repository)
	{
		$this->_mediator = $mediator;
		$this->_modules_repository = $user_modules_repository;
		$this->_user_domains_repository = $user_domains_repository;
	}

	/**
	 * @return \Illuminate\Config\Repository|mixed
	 */
	public function routePathPrefix() {
		return config( 'custom_modules.routes.path', 'm' );
	}

	/**
	 * @return \Illuminate\Config\Repository|mixed
	 */
	public function apiRoutePathPrefix() {
		return config( 'custom_modules.api_routes.path', 'a' );
	}

	/**
	 * @return string
	 */
	public function modulesPath() {
		return app_path() . '/../' . config( 'custom_modules.modules.path', 'modules' );
	}

	/**
	 * @return \Illuminate\Config\Repository|mixed
	 */
	protected function getConfig() {
		return config('custom_modules.modules');
	}

	/**
	 * @return array
	 */
	protected function getHooks() {

		return [
			'onInstall',
			'onBoot',
			'onRender',
			'onAction',
			'onAdminEdit',
			'onEdit',
			'onAdminUpdate',
			'onUpdate'
		];
	}

	/**
	 * @return array
	 */
	protected function getHttpMethods() {
		return [
			'GET',
			'POST',
			'PUT',
			'DELETE'
		];
	}

	/**
	 *
	 */
	protected function initHttpMethods() {
		if ( ! $this->_httpMethods ) {
			$this->_httpMethods = $this->getHttpMethods();
			$this->_registered_methods = [];
		}
	}

	/**
	 * @param $hook
	 * @param $moduleName
	 * @param $inst
	 * @param $callback
	 */
	private function addHook($hook, $moduleName, $inst, $callback) {

		if ( in_array($hook, $this->getHooks()) ) {
			$this->_mediator->attach($hook, $moduleName, $inst, $callback);
		} // do nothing if it is not part of a supported hooks

	}

	/**
	 * Convert module name with a_b to a camelcase AxxxByyy
	 * @param $moduleName
	 *
	 * @return string
	 */
	private function convertModuleName( $moduleName ) {
		if (strstr($moduleName, '_')) {
			$pieces = explode( "_", $moduleName );
			foreach ( $pieces as $key => $val ) {
				$pieces[ $key ] = ucfirst( $val );
			}

			return implode('', $pieces );
		}
		return $moduleName;
	}

	/**
	 * @param $hook
	 * @param $moduleName
	 * @param $module
	 * @param $parameters
	 *
	 * @return mixed
	 */
	public function onHook( $hook, $moduleName, $module, $parameters ) {

		$modName = $this->convertModuleName( $moduleName );
		return $this->_mediator->trigger($hook, $modName, $module, $parameters);

	}

	/**
	 * @param $module
	 *
	 * @return mixed
	 */
	public function getModule($module) {
		return $this->_modules_repository->getModule( $module );
	}

	/**
	 * @param $module
	 * @param $data
	 *
	 * @return |null
	 */
	public function updateModule($module, $data) {
		$mod = Module::where(['module_name' => $module])->first();

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
		return $this->_modules_repository->getUserModule( $module, $userId );
	}

	/**
	 * @param $module_id
	 * @param $userId
	 * @param $data
	 *
	 * @return mixed|null
	 */
	public function saveAdminModuleData($module_id, $userId, $data) {
		$mod = $this->_modules_repository->getAdminModuleById($module_id, $userId);
		// dnd([$mod, $userId]);
		if ($mod) {
			return $this->onHook( "onAdminUpdate", $mod->module->module_name, $mod, $data );
		}

		return null;
	}

	/**
	 * @param $module_id
	 * @param $userId
	 * @param $data
	 *
	 * @return mixed|null
	 */
	public function saveUserModuleData($module_id, $userId, $data) {

		$mod = $this->_modules_repository->getUserModuleById($module_id, $userId);
		if ($mod) {
			return $this->onHook( "onUpdate", $mod->module->module_name, $mod, $data);
		}

		return null;
	}

	/**
	 * @param $module_id
	 * @param $userId
	 *
	 * @return mixed
	 */
	public function editAdminModuleData($module_id, $userId) {
		$mod = $this->_modules_repository->getAdminModuleById($module_id, $userId);
		// dd([$mod, $userId, $mod->module]);
		if ($mod && $mod->module->supports_admin === self::SUPPORTS_ADMIN) {
			$data = json_decode($mod->data,true);
			$data = array_merge($data, request()->all());
			$newData = json_encode($data);
			// dd($newData);
			return $this->onHook( "onAdminEdit", $mod->module->module_name, $mod, $newData );
		}
	}

	public function getUserDomains($userid) {
		return $this->_user_domains_repository->getUserDomains( $userid );
	}

	/**
	 * @param $module_id
	 * @param $userId
	 *
	 * @return mixed|null
	 */
	public function editUserModuleData($module_id, $userId) {
		$mod = $this->_modules_repository->getUserModuleById($module_id, $userId);
		// dd([$module_id, $userId, $mod]);
		if ($mod && $mod->module->supports_user === self::SUPPORTS_USER) {

			$data = json_decode($mod->data,true);
			$data = array_merge($data, request()->all());
			$newData = json_encode($data);
			// dd($newData);
			return $this->onHook( "onEdit", $mod->module->module_name, $mod, $newData );
		}

		return null;
	}

	/**
	 * @param $userId
	 *
	 * @return mixed
	 */
	public function getModules($userId) {
		return $this->_modules_repository->getModules( $userId );
	}

	/**
	 * @param $userId
	 *
	 * @return mixed
	 */
	public function getUserModules($userId, $moduleType=null) {
		return $this->_modules_repository->getUserModules( $userId, $moduleType );
	}

	/**
	 * @param $module
	 * @param $userId
	 *
	 * @return mixed
	 */
	// Install Module used for admin
	/**
	 * @param $moduleName
	 * @param $userId
	 * @param bool $checked
	 *
	 * @return mixed
	 */
	public function toggleModule($moduleName, $userId, $checked = false) {

		// TODO: make sure that the module has not been installed already
		//       if so, if checked is false abort and return message.
		//       else, install over existing module ... Done!

		$modName = $this->convertModuleName( $moduleName );

		// dd($moduleName);

		$module = $this->_modules_repository->getModule( $moduleName );

		$data = json_decode($module['data'], true);
		$config = json_encode($data['config']);
		$parameters = json_encode($data['parameters']);

		// dnd([ $config,$parameters ]);

		if ($module) {
			return $this->onHook( "onInstall", $moduleName, $module, ["config" => $config, "parameters" => $parameters,  "checked" => $checked] );
		}
	}

	public function getAdminModule( $moduleName, $userId ) {
		return $this->_modules_repository->getAdminModule( $moduleName, $userId );
	}

	/**
	 * @param $moduleName
	 * @param $action
	 * @param null $options
	 *
	 * @return mixed|null
	 */
	public function customModuleAction( $moduleName, $action, $options = null ) {

		$module = $this->_modules_repository->getModule( $moduleName );

		// dd([$moduleName, $module, $action, $options]);

		if ( ! $module ) {
			return null;
		}

		if ($module['data'] !== null) {
			$config = json_decode($module['data'], true);
		} else {
			$config = null;
		}

		$host = request()->getSchemeAndHttpHost();

		// dd( [ "host" => $host, "config" => $config, "action" => $action, "options" => $options ]);

		$session_id = request()->session()->getId();

		return $this->onHook( "onAction", $moduleName, $module, [ "host" => $host, "config" => $config, "session_id" => $session_id, "action" => $action,  "options" => $options ] );
	}

	/**
	 * @param $moduleName
	 * @param $customInfo
	 *
	 * @return mixed|null
	 */
	public function moduleRender( $moduleName, $customInfo ) {

		$adminModule = $this->_modules_repository->getAdminModule( $moduleName, 1 );

		if ( $adminModule ) {

			$config = json_decode($adminModule['data'], true);
			$host = Request::getHost();
			$data = array_merge([ "host" => $host, "config" => $config ], ["arguments" => $customInfo] );
			return $this->onHook( "onRender", $moduleName, $adminModule, $data );

		} else {

			if (isset($customInfo['user_id'])) {
				$userModule = $this->_modules_repository->getUserModule( $moduleName, $customInfo['user_id'] );
				$config = json_decode($userModule['data'], true);
				$host = Request::getHost();
				$data = array_merge([ "host" => $host, "config" => $config ], ["arguments" => $customInfo] );
				return $this->onHook( "onRender", $moduleName, $adminModule, $data );
			}

		}

		return null;
	}

	/**
	 * @param $moduleName
	 * @param $userId
	 *
	 * @return mixed|null
	 */
	public function customModuleRender( $moduleName, $userId ) {

		$adminModule = $this->_modules_repository->getAdminModule( $moduleName, 1 );

		if ( ! $adminModule ) {
			return null;
		}

		$userModule = $this->_modules_repository->getUserModule( $moduleName, $userId );

		if ($userModule) {
			$config = json_decode($adminModule['data'], true);
			$parameters = json_decode($userModule['data'], true);

			$host = Request::getHost();

			return $this->onHook( "onRender", $moduleName, $userModule, [ "host" => $host, "config" => $config, "parameters" => $parameters ] );
		}
	}

	/**
	 * @param $module
	 * @param $userId
	 *
	 * @return mixed
	 */
	// Install Module used for user
	/**
	 * @param $moduleName
	 * @param $userId
	 * @param bool $checked
	 *
	 * @return mixed
	 */
	public function toggleUserModule($moduleName, $userId, $checked = false) {

		// TODO: make sure that the module has not been installed already
		//       if so, if checked is false abort and return message.
		//       else, install over existing module ... Done!

		$module = $this->_modules_repository->getModule( $moduleName );

		//dnd($module);

		$parameters = json_decode($module->data, true);

		if ($module && $module->supports_user === self::SUPPORTS_USER) {
			return $this->onHook( "onBoot", $moduleName, $module, ["parameters" => $parameters,  "checked" => $checked] );
		}
	}

	/**
	 * @return \Dzineer\CustomModules\Models\CustomModule[]|\Illuminate\Database\Eloquent\Collection
	 */
	public function getAllModules() {
		return $this->_modules_repository->getAllModules();
	}

	/**
	 * @param $moduleName
	 * @param $methods
	 */
	private function addFields($moduleName, $methods) {
		foreach (array_keys($methods) as $method) {
			if (in_array($method, $this->_httpMethods)) {
				Log::info("\nRegistering method: [ " . $method . "," . print_r($methods[ $method ], true) . " ]");
				$this->_registered_methods[ $method ][ $moduleName ] = $methods[ $method ];
			}
		}

	}

	/**
	 * @throws \ReflectionException
	 */
	public function loadModules() {

		$customModules = $this->getConfig();

		$this->initHttpMethods();

		// dd($customModules);

		$this->_modules = [];

		foreach($customModules as $module) {

			$reflectionClass = new \ReflectionClass( $module );
			$moduleName = $reflectionClass->getShortName();
			// dnd(["moduleName", $moduleName]);
			$moduleInst = new $module;

			if (method_exists($moduleInst, 'register')) {
				$result = $moduleInst->register();

				// dnd(["moduleInst->register", $result]);

				$methods = $result['methods'];
				$hooks = $result['hooks'];

				// registering all hooks for this module
				foreach( $hooks as $hook => $callback ) {
					$this->addHook($hook, $moduleName, $moduleInst, $callback);
				}
				// adding fields this module will allow for GET, POST, PUT, DELETE requests
				$this->addFields($moduleName, $methods);
			}

		}

	}

}