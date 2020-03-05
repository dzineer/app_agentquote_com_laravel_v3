<?php

namespace Dzineer\CustomModules\Facades;

use Illuminate\Support\Facades\Facade;

class CustomModules extends Facade {
	protected static function getFacadeAccessor() {
		return 'CustomModules';
	}

}