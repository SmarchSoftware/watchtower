<?php

namespace Smarch\Watchtower;

use Auth;
use Config;
use Illuminate\Support\ServiceProvider;

class WatchtowerServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // load the views
        $this->loadViewsFrom(__DIR__.'/Views', 'watchtower');

        // Publishes package files
        $this->publishes([
            __DIR__.'/Config/watchtower.php' => config_path('watchtower.php')
        ], 'config');

        $this->publishes([
            __DIR__.'/Config/watchtower-menu.php' => config_path('watchtower-menu.php')
        ], 'config-menu');

        $this->publishes([
            __DIR__.'/Views' => base_path('resources/views/vendor/watchtower')
        ], 'views');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Merge config files
        $this->mergeConfigFrom(__DIR__.'/Config/watchtower.php','watchtower');
        $this->mergeConfigFrom(__DIR__.'/Config/watchtower-menu.php','watchtower-menu');

        // load our routes
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/routes.php';
        }

        // View Composer
        $this->app['view']->composer('*',function($view){
           $view->theme = isset( Auth::user()->theme ) ? Auth::user()->theme : $this->app['config']->get('watchtower.default_theme');
           $view->title = $this->app['config']->get('watchtower.site_title');
        });

        // Register it
        $this->app->bind('watchtower', function() {
             return new Watchtower;
        });
    }
}
