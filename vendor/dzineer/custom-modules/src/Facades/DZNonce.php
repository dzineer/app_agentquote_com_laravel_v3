<?php

namespace Dzineer\CustomModules\Facades;

use Illuminate\Support\Facades\Facade;

class DZNonce extends Facade {

	protected static function getFacadeAccessor() {
		return 'DZNonce';
	}

}