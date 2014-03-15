<?php

/*
|--------------------------------------------------------------------------
| Default routes for Platform
|--------------------------------------------------------------------------
|
| Out of the box platform handles user authentication, password recovery and
| role management. These are typical in most applications. so they are part
| of the base setup. They are meant to be tweaked to your liking as most
| applications have different attributes for users.
|
*/
Route::group(Config::get('platform::routing'), function()
{
	$namespace = "Codesleeve\Platform\Controllers";
	$prefix = Config::get('platform::routing.prefix');

	// login/logout
	Route::get ('login', ["as" => "$prefix.sessions.create",  "uses" => "{$namespace}\SessionController@create"]);
	Route::post('login', ["as" => "$prefix.sessions.store",   "uses" => "{$namespace}\SessionController@store"]);
	Route::any ('logout',["as" => "$prefix.sessions.destroy", "uses" => "{$namespace}\SessionController@destroy"]);

	// password-reset
	Route::resource('password-reset', "{$namespace}\PasswordResetController");

	Route::group(['before' => 'platform.auth'], function() use ($prefix, $namespace)
	{
		// dashboard
		Route::get('/', ["as" => "$prefix.dashboard", "uses" => "{$namespace}\HomeController@dashboard"]);

		// roles
		Route::resource('roles', "{$namespace}\RoleController");

		// users
		Route::resource('users', "{$namespace}\UserController");
	});
});