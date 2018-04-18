<?php

namespace Aplr\Bouncer;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Illuminate\Contracts\Container\Container;

class ServiceProvider extends LaravelServiceProvider
{
	/**
	 * Register Bodybuilder package with Laravel
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerMigrations();
		
		$this->registerBouncer();
	}

    protected function registerMigrations()
    {
        $this->publishes([
            $this->migrationPath() => database_path('migrations')
        ], 'migrations');
    }

    protected function registerBouncer()
    {
        $this->app->singleton('bouncer', function (Container $app) {
            return new Bouncer();
		});
		
		$this->app->alias('bouncer', Bouncer::class);
    }
    
    protected function migrationPath()
    {
        return __DIR__ . '/../database/migrations';
    }

	/**
	 * Get the services provided by the provider.
	 *
	 * @return string[]
	 */
	public function provides()
	{
		return ['bouncer'];
	}
}
