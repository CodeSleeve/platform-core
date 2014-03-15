
Getting Started

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
	php artisan migrate --package codesleeve/platform
	php artisan db:seed --class "Codesleeve\Platform\Seeds\Platform"
```

you can setup extra stuff in your project by running the command but **this is only recommended for new projects**

```
	php artisan platform:setup
```