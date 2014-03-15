<?php

/*
|--------------------------------------------------------------------------
| platform_route
|--------------------------------------------------------------------------
|
| This macro is just an alias for route() but it appends on the prefix for us
| which is useful since this can change via the config file.
|
*/
if (!function_exists('platform_route'))
{
    function platform_route($route, $options = [])
    {
		$prefix = Config::get('platform::routing.prefix');
    	return route("{$prefix}.{$route}", $options);
    }
}
