<?php return [

	/*
	|--------------------------------------------------------------------------
	| prefix
	|--------------------------------------------------------------------------
	|
	| This is how we decide the url prefix to get to the admin panel
	|
	*/
	'prefix' => 'platform',

	/*
	|--------------------------------------------------------------------------
	| before filter
	|--------------------------------------------------------------------------
	|
	| Run this before filter on all platform routes
	|
	*/
	'before' => 'platform.csrf',

];