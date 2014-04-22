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
			'active' => 'dashboard',
			'priority' => 100,
		],
		[
			'title' => 'Groups',
			'icon' => 'fa-group',
			'url' => platform_route('groups.index'),
			'shown' => can('update', 'Group'),
			'active' => 'groups',
		],
		[
			'title' => 'Users',
			'icon' => 'fa-users',
			'url' => platform_route('users.index'),
			'shown' => can('update', 'User'),
			'active' => 'users',
		],
	]
];