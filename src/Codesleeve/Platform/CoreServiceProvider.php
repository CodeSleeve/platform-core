<?php namespace Codesleeve\Platform;

use App, Config, DirectoryIterator, Redirect, View;

class CoreServiceProvider extends \Illuminate\Support\ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$base = __DIR__;

		$this->package('codesleeve/platform');

		$this->bootMacros($base);

		$this->bootExceptionHandlers($base);

		$this->bootAssetPipeline($base);

		$this->bootViews($base);

		$this->bootNavigation($base);

		$this->bootBreadcrumbs($base);

		$this->bootSetupCommand($base);


		require_once("{$base}/../../routes.php");
		require_once("{$base}/../../filters.php");
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$base = __DIR__;

		App::register('Codesleeve\AssetPipeline\AssetPipelineServiceProvider');
		App::register('Codesleeve\Stapler\StaplerServiceProvider');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

	/**
	 * boot base macros that we can re-use in this
	 * entire application.
	 *
	 */
	protected function bootMacros($base)
	{
		$base = $base . '/../../macros';

		foreach (new DirectoryIterator($base) as $file)
		{
    		if ($file->isDot())
    		{
				continue;
    		}

    		require_once($base . '/' . $file->getFilename());
		}
	}

	/**
	 * boot the navigator for Platform
	 *
	 * @param  string $base
	 * @return void
	 */
	protected function bootNavigation($base)
	{
		$this->app['platform.navigation'] = $this->app->share(function($app)
		{
			return new Navigation\Navigator(Config::get('platform::navigation.main'));
		});
	}

	/**
	 * boot the breadcrumbs for Platform
	 *
	 * @param  string $base
	 * @return void
	 */
	protected function bootBreadcrumbs($base)
	{
		$this->app['platform.breadcrumbs'] = $this->app->share(function($app)
		{
			return new Navigation\Breadcrumbs;
		});
	}

	/**
	 * boot the setup command for Platform
	 *
	 * @param  string $base
	 * @return void
	 */
	protected function bootSetupCommand($base)
	{
		$this->app['platform.setup'] = $this->app->share(function($app)
		{
			return new Commands\PlatformSetupCommand;
		});

		$this->commands('platform.setup');
	}

	/**
	 * boot view namespaces for platform
	 *
	 * @param  string $base
	 * @return void
	 */
	protected function bootViews($base)
	{
		View::addNamespace('platform', $base . '/../../views');
	}

	/**
	 * This allows us to use validator exceptions gracefull throughout our application
	 *
	 * @param  string $base
	 * @return void
	 */
	protected function bootExceptionHandlers($base)
	{
		$this->app->error(function(Exceptions\ValidatorException $exception)
		{
    		return Redirect::to($exception->getAction())->withErrors($exception->getValidator())->withInput($exception->getInput());
		});
	}

	/**
	 * Tweak the configuration for asset pipeline for this application
	 * so we can use assets inside of the platform's assets directory
	 *
	 * We do this 'namespacing' so we don't clutter up our
	 * main app/assets directory with assets that belongs
	 * to codesleeve\platform.
	 *
	 * @param  string $base
	 * @return void
	 */
	protected function bootAssetPipeline($base)
	{
		$base = $base . '/../../assets';

		$asset = $this->app->make('asset');
		$config = $asset->getConfig();

		$config['paths'][] = str_replace($config['base_path'] .'/', '', realpath($base . "/javascripts"));
		$config['paths'][] = str_replace($config['base_path'] .'/', '', realpath($base . "/stylesheets"));
		$config['paths'][] = str_replace($config['base_path'] .'/', '', realpath($base . "/vendors"));

		$asset->setConfig($config);
	}
}
