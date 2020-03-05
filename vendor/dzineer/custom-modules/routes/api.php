<?php

// Route::view('m', 'custom_modules::test');

Route::get('m', 'ModuleController@index');
Route::get('c', 'CaptureLinkController@index');

