
### Getting Started

First add to composer.json

```
	"codesleeve/platform-core": "dev-master"
```

then add the service provider to the `providers` array in your `app\config\app.php`

```
	"Codesleeve\Platform\CoreServiceProvider",
```

then run commands for database

```
	php artisan migrate --package codesleeve/platform-core
	php artisan db:seed --class "Codesleeve\Platform\Seeds\Platform"
```

you can setup extra stuff in your project by running the command but **this is only recommended for new projects**

```
	php artisan platform:setup
```

### Adding your own navigation

You can easily tap into the navigation of platform by using the Navigation laravel facade or App::make('platform.navigation');


```
	$blog = [
		'title' => 'Blogs',
		'icon' => 'fa-pencil-square-o',
		'url' => route('blogs.index'),
		'shown' => can('update', 'Blogs'),
		'active' => 'blogs',
	];

	Navigation::add($blogs);
```

### Adjusting platform views

If you want to make a custom view you can modify any views after running

```
   $ php artisan view:publish codesleeve/platform-core
```

### Adding your own dashboard sections
**TODO**
Not implemented yet but on the radar.

```
Dashboard::add('view.name')
```

### Breadcrumbs helper

**TODO**
Add a tidbit about Breadcrumbs. Also add the ability to easily override the Breadcrumbs view that is made (just how the Pagination component works in Laravel);


### Additional helpers
**TODO**
Add the form helpers and macros we have in platform core here...


**TODO**

- I don't think we should rely on the BaseController for all the extra's. This would probably be better for a view.composer. Things like Breadcrumbs...

- Change the theme and colors to match the codesleeve.com website more... theme needs a little tinder love and care.


