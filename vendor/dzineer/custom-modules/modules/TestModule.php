<?php

namespace App\CustomModules;

use Dzineer\CustomModules\CustomModule;

class TestModule extends CustomModule {
	public function boot() {
		// TODO: Implement boot() method.
	}

	public function register() {
		echo "TestModule::register";
	}
}