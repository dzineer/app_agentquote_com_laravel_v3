<?php

namespace Dzineer\CustomModules\Http\Controllers;

use Carbon\Carbon;
use Dzineer\CustomModules\Facades\CustomModules;
use Dzineer\CustomModules\Facades\DZNonce;
use Illuminate\Routing\Controller;

class ModuleController extends Controller {

	public function test($module) {
		//return CustomModules::getModuleMethod($module, "GET");
		//return CustomModules::getMethods();
		if ( request()->has('id') ) {
			$current_timestamp = Carbon::now()->timestamp;
			$data = [
				'custom_module' => strtolower($module) . '_render_custom_module_' . $current_timestamp,
				'custom_module_name' => strtolower($module),
				'module_script' => 'custom_modules::modules.custom_modules.'. strtolower($module) . '.render',
				'action_script' => 'custom_modules::modules.actions.render',
				'action_module_name' =>  'custom_modules_render' . '_' . $current_timestamp,
				'communications_script' => 'custom_modules::modules.communications',
				'current_timestamp' => $current_timestamp,
				'fields' => json_encode(['id' => 1]),
				'module_name' => ucfirst($module),
			];
			return view('custom_modules::modules.custom_modules_container', $data);
		}

		return response()->json([ 'error' => 404, 'message' => 'Not found' ], 404);
	}

	public function getMethod($module) {
		return CustomModules::getModuleMethod($module, "GET");
		//return CustomModules::getMethods();
		if ( request()->has('id') ) {
			$current_timestamp = Carbon::now()->timestamp;
			$data = [
				'custom_module' => strtolower($module) . '_render_custom_module_' . $current_timestamp,
				'module_script' => 'custom_modules::modules.custom_modules.'. strtolower($module) . '.render',
				'action_script' => 'custom_modules::modules.actions.render',
				'action_module_name' =>  'custom_modules_render' . '_' . $current_timestamp,
				'communications_script' => 'custom_modules::modules.communications',
				'current_timestamp' => $current_timestamp,
				'fields' => json_encode([]),
				'module_name' => strtolower($module),
			];
			return view('custom_modules::modules.custom_modules_container', $data);
		}

		return response()->json([ 'error' => 404, 'message' => 'Not found' ], 404);
	}

	// render
	public function renderMethod($module) {
		//return CustomModules::getModuleMethod($module, "GET");
		//return CustomModules::getMethods();
		if ( request()->has('id') ) {
/*			$current_timestamp = Carbon::now()->timestamp;
			$data = [
				'custom_module' => strtolower($module) . '_render_custom_module_' . $current_timestamp,
				'module_script' => 'custom_modules::modules.custom_modules.'. strtolower($module) . '.render',
				'action_script' => 'custom_modules::modules.actions.render',
				'action_module_name' =>  'custom_modules_render' . '_' . $current_timestamp,
				'communications_script' => 'custom_modules::modules.communications',
				'current_timestamp' => $current_timestamp,
				'fields' => json_encode([]),
				'module_name' => strtolower($module),
			];*/

			return $this->handleRequest( 'GET', $module );

			// return view('custom_modules::modules.custom_modules_container', $data);
		}

		return response()->json([ 'error' => 404, 'message' => 'Not found' ], 404);
	}

	private function validFields($method, $module) {
		$validFields = CustomModules::getModuleMethod($module, $method);

		foreach(request()->all() as $field => $value) {
			// echo "\nfield: " . $field . " value: " . $value . "\n";
			if (!in_array($field, $validFields)) {
				return false;
			}
		}
		return true;
	}

	private function handleRequest( $method, $module ) {
		if ( ! $this->validFields( $method, $module )) {
			return "error invalid fields";
		}
		switch( $method ) {

			case "GET":
				return CustomModules::onHook( "onRender", $module, request() );

			case "POST":
				return CustomModules::onHook( "onUpdate", $module, request() );

			default:
				return response()->json([ 'error' => 404, 'message' => 'Not found' ], 404);
		}

		return "valid fields";;
	}

	public function postMethod($module) {
		// return request()->all();
		// return CustomModules::getModuleMethod($module, "POST");
		// return request()->all();
		return $this->handleRequest( "POST", $module );
	}

	public function putMethod($module) {
		return 'putMethod';
	}

	public function deleteMethod($module) {
		return 'deleteMethod';
	}
}