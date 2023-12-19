<?php

namespace HandsomeBrown\Laraca;

use App\Console\Commands\ArtyChannelCommand;
use App\Console\Commands\ArtyCommandCommand;
use HandsomeBrown\Laraca\Foundation\Console\ArtyCastCommand;
use HandsomeBrown\Laraca\Foundation\Console\ArtyModelCommand;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\ServiceProvider;

class LaracaServiceProvider extends ServiceProvider
{
    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        'ArtyCast' => ArtyCastCommand::class,
        'ArtyChannel' => ArtyChannelCommand::class,
        'ArtyCommand' => ArtyCommandCommand::class,
        'ArtyModel' => ArtyModelCommand::class,
    ];

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laraca');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'laraca');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laraca.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laraca'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laraca'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laraca'),
            ], 'lang');*/

            // Registering package commands.
            $this->registerCommands();
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laraca');

        // Register the main class to use with the facade
        $this->app->singleton('laraca', function () {
            return new Laraca;
        });
    }

    /**
     * Register the given commands.
     *
     * @return void
     */
    public function registerCommands()
    {
        foreach ($this->commands as $commandName => $command) {
            $method = "register{$commandName}Command";

            if (method_exists($this, $method)) {
                $this->{$method}();
            } else {
                if ($command instanceof GeneratorCommand) {
                    $this->app->singleton($command, function ($app, $command) {
                        return new ($command)($app['files']);
                    });
                } else {
                    $this->app->singleton($command);
                }
            }
        }

        $this->commands(array_values($this->commands));
    }
}
