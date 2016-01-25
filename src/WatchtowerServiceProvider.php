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
            __DIR__.'/Views' => base_path('resources/views/smarch/watchtower')
        ], 'views');

        // Merge config files
        $this->mergeConfigFrom(__DIR__.'/Config/watchtower.php','watchtower');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Grab appropriate routes file for version.
        $routes_file = __DIR__.'/routes.php';
        if ( str_contains( app()->version(), '5.2.' ) ){
            $routes_file = __DIR__.'/5.2_routes.php';
        } 

        // load our routes
        if (! $this->app->routesAreCached()) {
            require $routes_file;
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
