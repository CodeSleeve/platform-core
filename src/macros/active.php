<?php

/*
|--------------------------------------------------------------------------
| Active Macro
|--------------------------------------------------------------------------
|
| If the $link matches one of the active route patterns we search for then
| we return $active string else we return the $inactive string.
|
| Say we are visiting the action('FoobarController@show', [42]) which
| has a named route 'foobars' then here are 4 possible ways to return
| 'active' listed below:
|
| these would return active when we hit any show action for example
| both: http://localhost:8000/foobars/1 and http://localhost:8000/foobars/42
| would return 'active'
|
|   <?= active('FoobarController@show') ?>
|   <?= active('foobars.show') ?>
|
| However, these would only return active when we hit http://localhost:8000/foobars/42
|
|   <?= active('FoobarController@show', [42]) ?>
|   <?= active('foobars.show', [42]) ?>
|
*/
function active($link, $parameters = [], $active = 'active', $inactive = null)
{
    $link = strtolower($link);

    $routeAction = strtolower(Route::currentRouteAction());
    $routeName = strtolower(Route::currentRouteName());
    $controller = explode('@', $routeAction)[0];
    $currentParameters = Route::current()->parameters();

    $matches = array($routeAction, $controller);

    if ($routeName)
    {
        $matches[] = $routeName;
        $matches = array_merge($matches, explode('.', $routeName));
    }

    $match = in_array($link, $matches);

    foreach ($parameters as $parameter)
    {
        $match = $match && in_array($parameter, $currentParameters);
    }

    return $match ? $active : $inactive;
}