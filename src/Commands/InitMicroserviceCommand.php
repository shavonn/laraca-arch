<?php

namespace HandsomeBrown\Laraca\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;

#[AsCommand(name: 'init:micro')]
class InitMicroserviceCommand extends LaracaGeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'init:micro';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new microservice';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Microservice';

    /**
     * The microservice name.
     *
     * @var string
     */
    protected $serviceName = '';

    /**
     * The microservice path.
     *
     * @var string
     */
    protected $servicePath = '';

    /**
     * Generated files.
     *
     * @var array
     */
    protected $generated = [];

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle()
    {
        if ($this->input->hasOption('domain')) {
            $domainName = ucfirst($this->input->getOption('domain'));
            if (self::domainsEnabled() && $domainName) {
                $servicePath = self::assembleFullPath('microservice', $domainName);
            }
        } else {
            $servicePath = $this->assembleFullPath('microservice');
        }

        $this->serviceName = ucfirst($this->input->getArgument('name'));
        $this->servicePath = "$servicePath/$this->serviceName";

        $this->makeDirectories();

        $this->makeProviders();

        $this->makeRouteFiles();

        $this->makeFile('welcome', __DIR__ . '/stubs/welcome.stub');

        $this->components->bulletList($this->generated);
        $this->components->info('Microservice created successfully.');
        $this->components->info('Don\'t forget to <info>' . $this->serviceName . 'ServiceProvider.php</info> to providers in <info>app.php</info>');

        return Command::SUCCESS;
    }

    /**
     * Replace the tags for the given stub.
     */
    protected function replaceTags(string &$stub, string $name): string
    {
        $namespace = $this->rootNamespace();
        $controllerNamespace = $this->assembleNamespace('controller', null, $this->serviceName);

        $search = ['{{ namespace }}', '{{ slug }}', '{{ service }}', '{{ controller_namespace }}'];
        $replace = [$namespace, Str::slug($this->serviceName), $this->serviceName, $controllerNamespace];

        $stub = str_replace($search, $replace, $stub);

        return $stub;
    }

    /**
     * Get the console command arguments.
     */
    protected function makeRouteFiles(): void
    {
        $this->makeFile('web', __DIR__ . '/stubs/routes-web.stub');
        $this->makeFile('api', __DIR__ . '/stubs/routes-api.stub');
        $this->makeFile('channels', __DIR__ . '/stubs/routes-channels.stub');
    }

    /**
     * Get the console command arguments.
     */
    protected function makeDirectories(): void
    {
        $elements = [
            'channel',
            'controller',
            'provider',
            'route',
            'test',
            'view',
        ];

        foreach ($elements as $element) {
            switch ($element) {
                case 'route':
                    $path = "$this->servicePath/routes";
                    break;
                case 'test':
                    $path = "$this->servicePath/" . $this->assembleRelativePath('test', null, null, false);
                    break;
                case 'view':
                    $path = "$this->servicePath/" . $this->assembleRelativePath('view', null, null, false);
                    break;

                default:
                    $path = $this->assembleFullPath($element, null, $this->serviceName);
                    break;
            }

            $this->makeDirectory($path);
        }
    }

    /**
     * Get the console command arguments.
     */
    protected function makeProviders()
    {
        // RouteServiceProvider
        $routeProvider = $this->makeFile('RouteServiceProvider', __DIR__ . '/stubs/serviceprovider-route.stub');

        // BroadcastServiceProvider
        $broadcastProvider = $this->makeFile('BroadcastServiceProvider', __DIR__ . '/stubs/serviceprovider-broadcast.stub');

        // Root ServiceProvider
        $serviceProviderName = Str::of($this->serviceName)->finish('ServiceProvider');
        $serviceProvider = $this->makeFile($serviceProviderName, __DIR__ . '/stubs/serviceprovider.stub');
    }

    /**
     * Get the destination class path.
     */
    protected function getPath(string $name): string
    {
        $name = Str::of($name)->replaceFirst($this->rootNamespace(), '')->replace('\\', '/');

        $path = $this->servicePath;
        echo 'service ' . $path . "\n\n";

        switch ($name) {
            case 'BroadcastServiceProvider':
            case 'RouteServiceProvider':
                $path = $this->assembleFullPath('provider', null, $this->serviceName) . "/$name.php";
                break;
            case 'api':
            case 'channels':
            case 'web':
                $path = $path . "/routes/$name.php";
                break;
            case 'welcome':
                $path = app_path($this->assembleRelativePath('view', null, $this->serviceName) . "/$name.blade.php");
                break;
            default:
                $path = $path . "/$name.php";
        }
        echo $path . "\n\n";
        array_push($this->generated, $path);

        return $path;
    }

    /**
     * rootNamespace
     * Get the root namespace for the class.
     */
    protected function rootNamespace(): string
    {
        $namespace = parent::rootNamespace();

        return "$namespace\\$this->serviceName";
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the ' . strtolower($this->type)],
        ];
    }
}
