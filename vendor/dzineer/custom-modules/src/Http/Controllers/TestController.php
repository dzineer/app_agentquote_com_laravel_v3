<?php

namespace Dzineer\CustomModules\Http\Controllers;

use Illuminate\Routing\Controller;

class TestController extends Controller {
	public function renderMethod($method) {
		dd($method);
		return 'in controller';
	}
}