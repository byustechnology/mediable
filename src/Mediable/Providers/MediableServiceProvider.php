<?php

namespace ByusTechnology\Mediable\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

class MediableServiceProvider extends ServiceProvider
{
    
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        // Setting the routes.
        // $this->loadRoutesFrom(__DIR__ . '/../../routes/routes.php');
        // Setting the views directory and aliases.
        // $this->loadViewsFrom(__DIR__ . '/../../views', 'mediable');
        // Setting the migrations.
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations/');

        // Register factories
        // $this->registerEloquentFactoriesFrom(__DIR__ . '/../../database/factories');

        // Observers
        // ...
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/mediable.php', 'mediable');
    }

    /**
     * Register factories.
     *
     * @param  string  $path
     * @return void
     */
    public function registerEloquentFactoriesFrom($path)
    {
        $this->app->make(EloquentFactory::class)->load($path);
    }
}