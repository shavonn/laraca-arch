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
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle()
    {
        if ($this->input->hasArgument('domain')) {
            $domain = ucfirst($this->input->getArgument('domain'));
            if (self::domainsEnabled() && $domain) {
                $servicePath = self::assembleFullPath('microservice', $domain);
            }
        } else {
            $servicePath = $this->assembleFullPath('microservice');
        }

        $this->serviceName = ucfirst($this->input->getArgument('name'));
        $this->servicePath = "$servicePath/$this->serviceName";

        $this->makeDirectories();

        $this->makeProviders();

        $this->makeRouteFiles();

        $elements = Config::get('laraca.struct.microservice.elements');

        if (in_array('route', $elements)) {
            $this->makeFile('welcome', __DIR__.'/stubs/welcome.stub');
        }

        $this->components->info('Microservice created successfully.');
        $this->components->info('Don\'t forget to <info>'.$this->serviceName.'ServiceProvider.php</info> to providers in <info>app.php</info>');

        return Command::SUCCESS;
    }

    /**
     * Replace the tags for the given stub.
     */
    protected function replaceTags(string &$stub, string $name): string
    {
        $namespace = $this->rootNamespace();
        $controllerNamespace = $this->assembleNamespace('controller', null, false);
        $controllerNamespace = "$namespace\\$controllerNamespace";

        $elements = Config::get('laraca.struct.microservice.elements');

        $use = '';

        if ($name == $this->serviceName.'ServiceProvider') {
            if (in_array('route', $elements)) {
                $use = $use."use $namespace\Providers\RouteServiceProvider;\n";
            }

            if (in_array('channel', $elements)) {
                $use = $use."use $namespace\Providers\BroadcastServiceProvider;\n";
            }

            if (in_array('view', $elements) || in_array('component', $elements)) {
                $use = $use."use Illuminate\Support\Facades\View;\n";
            }
        }

        $search = ['{{ namespace }}', '{{ slug }}', '{{ service }}', '{{ controller_namespace }}', '{{ use }}'];
        $replace = [$namespace, Str::slug($this->serviceName), $this->serviceName, $controllerNamespace, $use];

        $stub = str_replace($search, $replace, $stub);

        return $stub;
    }

    /**
     * Get the console command arguments.
     */
    protected function makeRouteFiles(): void
    {
        $elements = Config::get('laraca.struct.microservice.elements');

        if (in_array('route', $elements)) {
            $this->makeFile('web', __DIR__.'/stubs/routes-web.stub');
            $this->makeFile('api', __DIR__.'/stubs/routes-api.stub');
        }

        if (in_array('channel', $elements)) {
            $this->makeFile('channels', __DIR__.'/stubs/routes-channels.stub');
        }
    }

    /**
     * Get the console command arguments.
     */
    protected function makeDirectories(): void
    {
        $elements = Config::get('laraca.struct.microservice.elements');

        foreach ($elements as $element) {
            switch ($element) {
                case 'route':
                    $path = 'routes';
                    break;

                default:
                    $path = $this->assembleRelativePath($element, null, false);
                    break;
            }

            $path = "$this->servicePath/$path";

            $this->makeDirectory($path);
        }
    }

    /**
     * Get the console command arguments.
     */
    protected function makeProviders()
    {
        $providers = [];
        $elements = Config::get('laraca.struct.microservice.elements');

        $search = ['{{ register }}', '{{ boot }}'];

        $register = '';
        $boot = '';

        if (in_array('route', $elements)) {
            $routeProvider = $this->makeFile('RouteServiceProvider', __DIR__.'/stubs/serviceprovider-route.stub');
            array_push($providers, $routeProvider);

            $register = $register.'$this->app->register(RouteServiceProvider::class);'."\n";
        }

        if (in_array('channel', $elements)) {
            $broadcastProvider = $this->makeFile('BroadcastServiceProvider', __DIR__.'/stubs/serviceprovider-broadcast.stub');
            array_push($providers, $broadcastProvider);

            $register = $register ? $register."\t\t" : $register;
            $register = $register.'$this->app->register(BroadcastServiceProvider::class);'."\n";
        }

        if (in_array('view', $elements) || in_array('component', $elements)) {
            $register = $register ? $register."\n\t\t" : $register;
            $register = $register."View::addNamespace('".$this->serviceName."', realpath(__DIR__.'/../resources/views'));";
        }

        $serviceProviderName = Str::of($this->serviceName)->finish('ServiceProvider');
        $serviceProvider = $this->makeFile($serviceProviderName, __DIR__.'/stubs/serviceprovider.stub');
        array_push($providers, $serviceProvider);

        $replace = [$register, ($boot ? $boot : '//')];
        $this->files->replaceInFile($search, $replace, $serviceProvider);
    }

    /**
     * Get the destination class path.
     */
    protected function getPath(string $name): string
    {
        $name = Str::of($name)->replaceFirst($this->rootNamespace(), '')->replace('\\', '/');

        $path = $this->servicePath;

        switch ($name) {
            case 'BroadcastServiceProvider':
            case 'RouteServiceProvider':
                $path = $path.'/Providers';
                break;
            case 'api':
            case 'channels':
            case 'web':
                $path = $path.'/routes';
                break;
            case 'welcome':
                echo $path."/resources/views/$name.blade.php";

                return $path = $path."/resources/views/$name.blade.php";
                break;
        }

        return $path."/$name.php";
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
            ['name', InputArgument::REQUIRED, 'The name of the '.strtolower($this->type)],
        ];
    }
}
