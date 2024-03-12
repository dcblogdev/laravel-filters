<?php

namespace Dcblogdev\Filters;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Route;

class FiltersServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {

            // Publishing the configuration file.
            $this->publishes([
                __DIR__.'/../config/filters.php' => config_path('filters.php'),
            ], 'config');

            $timestamp = date('Y_m_d_His', time());

            $this->publishes([
                __DIR__.'/database/migrations/create_filters_table.php' => $this->app->databasePath()."/migrations/{$timestamp}_create_filters_table.php",
            ], 'migrations');            
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/filters.php', 'filters');

        // Register the service the package provides.
        $this->app->singleton('filters', function ($app) {
            return new Filters;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['filters'];
    }
}
