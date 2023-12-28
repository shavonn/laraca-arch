<?php

namespace HandsomeBrown\Laraca;

use HandsomeBrown\Laraca\Commands\ArtiMigrationCommand;
use HandsomeBrown\Laraca\Commands\DomainListCommand;
use HandsomeBrown\Laraca\Commands\InitStructureCommand;
use HandsomeBrown\Laraca\Commands\MakeCastCommand;
use HandsomeBrown\Laraca\Commands\MakeChannelCommand;
use HandsomeBrown\Laraca\Commands\MakeCommandCommand;
use HandsomeBrown\Laraca\Commands\MakeComponentCommand;
use HandsomeBrown\Laraca\Commands\MakeControllerCommand;
use HandsomeBrown\Laraca\Commands\MakeEnumCommand;
use HandsomeBrown\Laraca\Commands\MakeEventCommand;
use HandsomeBrown\Laraca\Commands\MakeExceptionCommand;
use HandsomeBrown\Laraca\Commands\MakeFactoryCommand;
use HandsomeBrown\Laraca\Commands\MakeJobCommand;
use HandsomeBrown\Laraca\Commands\MakeListenerCommand;
use HandsomeBrown\Laraca\Commands\MakeMailCommand;
use HandsomeBrown\Laraca\Commands\MakeMiddlewareCommand;
use HandsomeBrown\Laraca\Commands\MakeModelCommand;
use HandsomeBrown\Laraca\Commands\MakeNotificationCommand;
use HandsomeBrown\Laraca\Commands\MakeObserverCommand;
use HandsomeBrown\Laraca\Commands\MakePolicyCommand;
use HandsomeBrown\Laraca\Commands\MakeProviderCommand;
use HandsomeBrown\Laraca\Commands\MakeRequestCommand;
use HandsomeBrown\Laraca\Commands\MakeResourceCommand;
use HandsomeBrown\Laraca\Commands\MakeRuleCommand;
use HandsomeBrown\Laraca\Commands\MakeScopeCommand;
use HandsomeBrown\Laraca\Commands\MakeSeederCommand;
use HandsomeBrown\Laraca\Commands\MakeTestCommand;
use HandsomeBrown\Laraca\Commands\MakeValueCommand;
use HandsomeBrown\Laraca\Commands\MakeViewCommand;
use HandsomeBrown\Laraca\Concerns\GetsConfigValues;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class LaracaServiceProvider extends ServiceProvider
{
    use GetsConfigValues;

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
        'ArtiMigration' => ArtiMigrationCommand::class,
        'MakeCast' => MakeCastCommand::class,
        'MakeChannel' => MakeChannelCommand::class,
        'MakeCommand' => MakeCommandCommand::class,
        'MakeComponent' => MakeComponentCommand::class,
        'MakeController' => MakeControllerCommand::class,
        'MakeEvent' => MakeEventCommand::class,
        'MakeEnum' => MakeEnumCommand::class,
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
        'MakeStructure' => InitStructureCommand::class,
        'MakeTest' => MakeTestCommand::class,
        'MakeValue' => MakeValueCommand::class,
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

            $this->app->useDatabasePath($this->assembleFullPath('database'));

            $domainsEnabled = Config::get('laraca.domains.enabled');
            $domainsParentDir = Config::get('laraca.domains.parent_dir');

            if ($domainsEnabled && $domainsParentDir) {
                $this->commands['DomainList'] = DomainListCommand::class;
            }

            // Registering package commands.
            $this->registerCommands();
        }

        $this->loadViewsFrom($this->assembleFullPath('view'), 'laraca');

        $this->loadMigrationsFrom($this->assembleFullPath('migration'));
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
     * registerArtiMigrationCommand
     * Register the command.
     */
    protected function registerArtiMigrationCommand(): void
    {
        $this->app->singleton(ArtiMigrationCommand::class, function ($app) {
            $creator = $app['migration.creator'];
            $composer = $app['composer'];

            return new ArtiMigrationCommand($creator, $composer);
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
