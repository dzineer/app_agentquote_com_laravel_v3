<?php

return [

	'modules' => [
		\App\CustomModules\Test::class
	],

	/*
	|--------------------------------------------------------------------------
	| Scripts
	|--------------------------------------------------------------------------
	|
	| Here you can specify the driver class that you want to support.
	| This allows us to extend the Driver class to anything we want.
	|
	*/

	'scripts' => [
		'path' => '/custom_modules',
		'editor' => 'custom_modules_edit.js',
		'update' => 'custom_modules_update.js',
		'load' => 'custom_modules.js'
	],

	/*
	|--------------------------------------------------------------------------
	| File Driver Options
	|--------------------------------------------------------------------------
	|
	| Here you can specify any configuration options that should be used with
	| the file driver. The path option is a path to the directory with all
	| the markdown files that will be processed inside the command.
	|
	| Supported: "file", "database"
	|
	*/

	'file' => [
		'path' => '../custom_modules',
	],

	/*
	|--------------------------------------------------------------------------
	| Routes Options
	|--------------------------------------------------------------------------
	|
	| Here you can specify any configuration options that should be used with
	| routes. To prevent URL path collisions, the path option is a prefix to
	| the URL when accessing our unique defined routes.
	|
	*/

	'routes' => [
		'path' => 'm',
		'default' => '/'
	],

	'api_routes' => [
		'path' => 'a',
		'default' => '/'
	]

];
