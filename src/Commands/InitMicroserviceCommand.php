<?php

namespace HandsomeBrown\Laraca\Commands;

use HandsomeBrown\Laraca\Commands\Traits\Directable;
use Illuminate\Support\Str;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;

#[AsCommand(name: 'init:micro')]
class InitMicroserviceCommand extends LaracaGeneratorCommand
{
    use Directable;

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
     * Execute the console command.
     *
     * @return bool|void
     */
    public function handle()
    {
        $this->serviceName = $this->formatName($this->input->getArgument('name'));

        if (! parent::handle()) {
            return false;
        }

        $this->makeDirectories();

        $this->makeProviders();

        $this->makeRouteFiles();

        $this->makeFile('welcome', __DIR__.'/stubs/welcome.stub');

        $this->components->bulletList($this->generated);
        $this->components->info('Microservice created successfully.');
        $this->components->info('Don\'t forget to <info>'.$this->serviceName.'ServiceProvider.php</info> to providers in <info>app.php</info>');
    }

    /**
     * Replace the tags for the given stub.
     */
    protected function replaceTags(string &$stub, string $name): string
    {
        $controllerNamespace = $this->getConfigNamespace('controller', null, $this->serviceName);

        $search = ['{{ namespace }}', '{{ slug }}', '{{ service }}', '{{ controller_namespace }}'];
        $replace = [$this->getServiceNamespace(), Str::slug($this->serviceName), $this->serviceName, $controllerNamespace];

        $stub = str_replace($search, $replace, $stub);

        return $stub;
    }

    /**
     * Get the console command arguments.
     */
    protected function makeRouteFiles(): void
    {
        $this->makeFile('web', __DIR__.'/stubs/routes-web.stub');
        $this->makeFile('api', __DIR__.'/stubs/routes-api.stub');
        $this->makeFile('channels', __DIR__.'/stubs/routes-channels.stub');
    }

    /**
     * Get the console command arguments.
     */
    protected function makeDirectories(): void
    {
        $elements = [
            'channel',
            'controller',
            'migration',
            'provider',
            'route',
            'test',
            'view',
        ];

        $path = $this->getServicePath().'/';

        foreach ($elements as $element) {
            $dir = '';
            switch ($element) {
                case 'route':
                    $dir = $path.'routes';
                    break;

                default:
                    $dir = $path.$this->getBasePath($element);
                    break;
            }
            $this->makeDirectory($dir);
        }
    }

    /**
     * Get the console command arguments.
     */
    protected function makeProviders(): void
    {
        // RouteServiceProvider
        $this->makeFile('RouteServiceProvider', __DIR__.'/stubs/serviceprovider-route.stub');

        // BroadcastServiceProvider
        $this->makeFile('BroadcastServiceProvider', __DIR__.'/stubs/serviceprovider-broadcast.stub');

        // Root ServiceProvider
        $serviceProviderName = Str::of($this->serviceName)->finish('ServiceProvider');
        $this->makeFile($serviceProviderName, __DIR__.'/stubs/serviceprovider.stub');
    }

    /**
     * Get the destination class path.
     */
    protected function getPath(string $name): string
    {
        $name = Str::of($name)->replaceFirst($this->getServiceNamespace(), '')->replace('\\', '/');

        $path = $this->getServicePath().'/';

        switch ($name) {
            case 'BroadcastServiceProvider':
            case 'RouteServiceProvider':
                $path = $path.$this->getBasePath('provider')."/$name.php";
                break;
            case 'api':
            case 'channels':
            case 'web':
                $path = $path."routes/$name.php";
                break;
            case 'welcome':
                $path = $path.$this->getBasePath('view')."/$name.blade.php";
                break;
            default:
                $path = $path."$name.php";
        }

        return $path;
    }

    protected function getServiceNamespace(): string
    {
        $namespace = $this->getConfigNamespaceWithOptions($this->configKey);

        return "$namespace\\$this->serviceName";
    }

    protected function getServicePath(): string
    {
        $path = $this->getConfigPathWithOptions($this->configKey);

        return "$path/$this->serviceName";
    }

    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName)
    {
        $serviceProviderName = Str::of($this->serviceName)->finish('ServiceProvider');

        return $this->files->exists($this->getPath($serviceProviderName));
    }

    /**
     * Get the console command arguments.
     *
     * @return array<int,array<int,int|string>>
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the '.strtolower($this->type)],
        ];
    }
}
