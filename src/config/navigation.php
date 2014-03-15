<?php return [

	/*
	|--------------------------------------------------------------------------
	| navigation
	|--------------------------------------------------------------------------
	|
	| This is the default navigation for the backend admin panel. It is easily
	| customizable if we want to change things here.
	|
	*/
	'main' => [
		[
			'title' => 'Dashboard',
			'icon' => 'fa-dashboard',
			'url' => platform_route('dashboard'),
			'shown' => can('view', 'Dashboard'),
			'active' => active('dashboard'),
		],
		[
			'title' => 'Roles',
			'icon' => 'fa-eye',
			'url' => platform_route('roles.index'),
			'shown' => can('update', 'Role'),
			'active' => active('roles'),
		],
		[
			'title' => 'Users',
			'icon' => 'fa-users',
			'url' => platform_route('users.index'),
			'shown' => can('update', 'User'),
			'active' => active('users'),
		],
	]
];