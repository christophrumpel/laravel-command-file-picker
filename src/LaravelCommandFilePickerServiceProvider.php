<?php

namespace Christophrumpel\LaravelCommandFilePicker;

use Christophrumpel\LaravelCommandFilePicker\Tests\Commands\TestCommand;
use Illuminate\Support\ServiceProvider;

class LaravelCommandFilePickerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-command-file-picker');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-command-file-picker');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/command-file-picker.php' => config_path('laravel-command-file-picker.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-command-file-picker'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-command-file-picker'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-command-file-picker'),
            ], 'lang');*/

            // Registering package commands.
            $this->commands([
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/command-file-picker.php', 'command-file-picker');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-command-file-picker', function () {
            return new LaravelCommandFilePicker;
        });
    }
}
