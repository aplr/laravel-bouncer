<?php

namespace Aplr\Bouncer;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Illuminate\Contracts\Container\Container;

class ServiceProvider extends LaravelServiceProvider
{
    public function boot()
    {
        $this->registerConfig();

        $this->registerMigrations();
	}
	
	public function register()
	{
        $this->mergeConfigFrom($this->configPath(), 'bouncer');
		
		$this->registerBouncer();
	}

    protected function registerConfig()
    {
        $this->publishes([
            $this->configPath() => config_path('bouncer.php')
        ], 'config');
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
    
    protected function configPath()
    {
        return __DIR__ . '/../config/bouncer.php';
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
