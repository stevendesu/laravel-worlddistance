<?php namespace Stevendesu\WorldDistance;

use Illuminate\Support\ServiceProvider;

class WorldDistanceServiceProvider extends ServiceProvider {

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
		$this->publishes([
			__DIR__.'/../config/worlddistance.php' => config_path('worlddistance.php'),
		]);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// Register providers.
		$this->app['distance'] = $this->app->share(function($app)
		{
			return new WorldDistance($app['config'], $app['db']);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['distance'];
	}

}
