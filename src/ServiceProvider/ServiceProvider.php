<?php

namespace Cirote\Estrategias\ServiceProvider;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Cirote\Estrategias\Actions\LeerDatosAction as LeerDatos;
use Cirote\Estrategias\Interfaces\IolInterface;

class ServiceProvider extends BaseServiceProvider
{
	public function register()
	{
		$this->register_migrations();

		$this->register_routes();

		$this->register_views();
	}

	public function boot()
	{
		//	$this->loadTranslationsFrom(__DIR__ . '/../Translations', 'estrategias');

		$this->bind_class();
	}

	private function bind_class()
	{
		$this->app->singleton(IolInterface::class, function ($app) 
		{
    		return new IolInterface();
		});

		$this->app->singleton(LeerDatos::class, function ($app) 
		{
    		return new LeerDatos($app->make(IolInterface::class));
		});
	}

	private function register_migrations()
	{
		$this->loadMigrationsFrom(__DIR__ . '/../Migrations');
	}

	private function register_routes()
	{
		$this->loadRoutesFrom(__DIR__ . '/../Routes/routes.php');
	}

	private function register_views()
	{
		$this->loadViewsFrom(__DIR__ . '/../Views', 'estrategias');
	}

}