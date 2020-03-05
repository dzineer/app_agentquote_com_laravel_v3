<?php

return [

	'modules' => [
		\App\CustomModules\TermlifeModule::class,
		\App\CustomModules\FeModule::class,
		\App\CustomModules\GoogleAnalyticsModule::class,
		\App\CustomModules\PageChoiceModule::class,
		\App\CustomModules\PhoneValidationModule::class,
		\App\CustomModules\PagesModule::class,
		\App\CustomModules\UserCustomPagesModule::class,
		\App\CustomModules\UserPagesModule::class,
		\App\CustomModules\WhmcsApiModule::class,
		\App\CustomModules\PageMenuModule::class,
		\App\CustomModules\UserPageMenuModule::class,
		\App\CustomModules\DomainsModule::class,
        \App\CustomModules\CustomThemeModule::class
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
        'render' => 'custom_modules_render.js'
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
	]

];
