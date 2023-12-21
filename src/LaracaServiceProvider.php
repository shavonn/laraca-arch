<?php

namespace HandsomeBrown\Laraca;

use HandsomeBrown\Laraca\Foundation\Console\ArtyCastCommand;
use HandsomeBrown\Laraca\Foundation\Console\ArtyChannelCommand;
use HandsomeBrown\Laraca\Foundation\Console\ArtyCommandCommand;
use HandsomeBrown\Laraca\Foundation\Console\ArtyComponentCommand;
use HandsomeBrown\Laraca\Foundation\Console\ArtyControllerCommand;
use HandsomeBrown\Laraca\Foundation\Console\ArtyEventCommand;
use HandsomeBrown\Laraca\Foundation\Console\ArtyExceptionCommand;
use HandsomeBrown\Laraca\Foundation\Console\ArtyFactoryCommand;
use HandsomeBrown\Laraca\Foundation\Console\ArtyJobCommand;
use HandsomeBrown\Laraca\Foundation\Console\ArtyListenerCommand;
use HandsomeBrown\Laraca\Foundation\Console\ArtyMailCommand;
use HandsomeBrown\Laraca\Foundation\Console\ArtyMiddlewareCommand;
use HandsomeBrown\Laraca\Foundation\Console\ArtyMigrationCommand;
use HandsomeBrown\Laraca\Foundation\Console\ArtyModelCommand;
use HandsomeBrown\Laraca\Foundation\Console\ArtyNotificationCommand;
use HandsomeBrown\Laraca\Foundation\Console\ArtyObserverCommand;
use HandsomeBrown\Laraca\Foundation\Console\ArtyPolicyCommand;
use HandsomeBrown\Laraca\Foundation\Console\ArtyProviderCommand;
use HandsomeBrown\Laraca\Foundation\Console\ArtyRequestCommand;
use HandsomeBrown\Laraca\Foundation\Console\ArtyResourceCommand;
use HandsomeBrown\Laraca\Foundation\Console\ArtyRuleCommand;
use HandsomeBrown\Laraca\Foundation\Console\ArtyScopeCommand;
use HandsomeBrown\Laraca\Foundation\Console\ArtySeederCommand;
use HandsomeBrown\Laraca\Foundation\Console\ArtyTestCommand;
use HandsomeBrown\Laraca\Foundation\Console\ArtyViewCommand;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\ServiceProvider;

class LaracaServiceProvider extends ServiceProvider
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * commands
     * The commands to be registered.
     *
     * @var array<string,mixed>
     */
    protected $commands = [
        'ArtyCast' => ArtyCastCommand::class,
        'ArtyChannel' => ArtyChannelCommand::class,
        'ArtyCommand' => ArtyCommandCommand::class,
        'ArtyComponent' => ArtyComponentCommand::class,
        'ArtyController' => ArtyControllerCommand::class,
        'ArtyEvent' => ArtyEventCommand::class,
        'ArtyException' => ArtyExceptionCommand::class,
        'ArtyFactory' => ArtyFactoryCommand::class,
        'ArtyJob' => ArtyJobCommand::class,
        'ArtyListener' => ArtyListenerCommand::class,
        'ArtyMail' => ArtyMailCommand::class,
        'ArtyMiddleware' => ArtyMiddlewareCommand::class,
        'ArtyMigration' => ArtyMigrationCommand::class,
        'ArtyModel' => ArtyModelCommand::class,
        'ArtyNotification' => ArtyNotificationCommand::class,
        'ArtyObserver' => ArtyObserverCommand::class,
        'ArtyPolicy' => ArtyPolicyCommand::class,
        'ArtyProvider' => ArtyProviderCommand::class,
        'ArtyRequest' => ArtyRequestCommand::class,
        'ArtyResource' => ArtyResourceCommand::class,
        'ArtyRule' => ArtyRuleCommand::class,
        'ArtyScope' => ArtyScopeCommand::class,
        'ArtySeeder' => ArtySeederCommand::class,
        'ArtyTest' => ArtyTestCommand::class,
        'ArtyView' => ArtyViewCommand::class,
    ];

    /**
     * boot
     * Bootstrap the application services.
     *
     * @return void
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
            ], 'laraca-config');

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

            $this->app->useDatabasePath(config('laraca.database.path'));

            // Registering package commands.
            $this->registerCommands();
        }
    }

    /**
     * register
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laraca');
    }

    /**
     * registerCommands
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
                    $this->app->singleton(($command)->getName() ?? '', function ($app, $command) {
                        return new ($command)($app['files']);
                    });
                } else {
                    $this->app->singleton($command);
                }
            }
        }

        $this->commands(array_values($this->commands));
    }

    /**
     * registerArtyMigrationCommand
     * Register the command.
     *
     * @return void
     */
    protected function registerArtyMigrationCommand()
    {
        $this->app->singleton(ArtyMigrationCommand::class, function ($app) {
            $creator = $app['migration.creator'];
            $composer = $app['composer'];

            return new ArtyMigrationCommand($creator, $composer);
        });
    }

    /**
     * provides
     * Get the services provided by the provider.
     *
     * @return array<mixed>
     */
    public function provides(): array
    {
        return array_values($this->commands);
    }
}
