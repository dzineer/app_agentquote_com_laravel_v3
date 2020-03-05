<?php

namespace Dzineer\CustomModules;

interface iCustomModule {
	public function boot( $module, $package );
	public function install( $module, $package );
	public function register();
	public function getMethods();
	public function getHooks();
}