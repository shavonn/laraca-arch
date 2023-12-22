<?php

namespace HandsomeBrown\Laraca;

use HandsomeBrown\Laraca\Foundation\Console\Artisan\ArtyMigrationCommand;
use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeCastCommand;
use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeChannelCommand;
use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeCommandCommand;
use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeComponentCommand;
use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeControllerCommand;
use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeEventCommand;
use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeExceptionCommand;
use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeFactoryCommand;
use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeJobCommand;
use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeListenerCommand;
use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeMailCommand;
use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeMiddlewareCommand;
use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeModelCommand;
use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeNotificationCommand;
use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeObserverCommand;
use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakePolicyCommand;
use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeProviderCommand;
use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeRequestCommand;
use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeResourceCommand;
use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeRuleCommand;
use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeScopeCommand;
use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeSeederCommand;
use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeTestCommand;
use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeViewCommand;
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
        'ArtyMigration' => ArtyMigrationCommand::class,
        'MakeCast' => MakeCastCommand::class,
        'MakeChannel' => MakeChannelCommand::class,
        'MakeCommand' => MakeCommandCommand::class,
        'MakeComponent' => MakeComponentCommand::class,
        'MakeController' => MakeControllerCommand::class,
        'MakeEvent' => MakeEventCommand::class,
        'MakeException' => MakeExceptionCommand::class,
        'MakeFactory' => MakeFactoryCommand::class,
        'MakeJob' => MakeJobCommand::class,
        'MakeListener' => MakeListenerCommand::class,
        'MakeMail' => MakeMailCommand::class,
        'MakeMiddleware' => MakeMiddlewareCommand::class,
        'MakeModel' => MakeModelCommand::class,
        'MakeNotification' => MakeNotificationCommand::class,
        'MakeObserver' => MakeObserverCommand::class,
        'MakePolicy' => MakePolicyCommand::class,
        'MakeProvider' => MakeProviderCommand::class,
        'MakeRequest' => MakeRequestCommand::class,
        'MakeResource' => MakeResourceCommand::class,
        'MakeRule' => MakeRuleCommand::class,
        'MakeScope' => MakeScopeCommand::class,
        'MakeSeeder' => MakeSeederCommand::class,
        'MakeTest' => MakeTestCommand::class,
        'MakeView' => MakeViewCommand::class,
    ];

    /**
     * boot
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laraca.php'),
            ], 'laraca-config');

            $this->app->useDatabasePath(base_path(config('laraca.database.path')));

            // Registering package commands.
            $this->registerCommands();
        }
    }

    /**
     * register
     * Register the application services.
     */
    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laraca');
    }

    /**
     * registerCommands
     * Register the given commands.
     */
    public function registerCommands(): void
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
     */
    protected function registerArtyMigrationCommand(): void
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
