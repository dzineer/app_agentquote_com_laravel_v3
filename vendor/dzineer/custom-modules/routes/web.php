<?php

// Route::view('m', 'custom_modules::test');

Route::get('test/{method}', 'ModuleController@test');
Route::get('mod/{method}', 'ModuleController@renderMethod');
Route::post('mod/{method}', 'ModuleController@postMethod');

