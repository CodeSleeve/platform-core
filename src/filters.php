<?php

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('platform.csrf', function($route, $request)
{
	if (strtoupper($request->getMethod()) === 'GET' || App::environment() == "local") {
		return;
	}

	$token = $request->ajax() ? $request->header('X-CSRF-Token') : Input::get('_token');

	if (Session::token() != $token)
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

/*
|--------------------------------------------------------------------------
| Authentication Filters For Platform
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('platform.auth', function()
{
	if (Auth::guest())
	{
		$prefix = Config::get('platform::routing.prefix');

		return Redirect::guest("$prefix/login");
	}
});