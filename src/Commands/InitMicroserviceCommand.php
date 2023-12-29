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

        $providers = $this->makeProviders();

        $this->makeRouteFiles();

        // welcome view

        $this->components->info('Service created successfully.');
        $this->components->bulletList($providers);

        return Command::SUCCESS;
    }

    /**
     * Add additional template tags
     */
    protected function addAdditionalTags(string &$stub): void
    {
        $searchRegister = 'public function register(): void
    {
        //';
        $searchBoost = 'public function boot(): void
    {
        //';
        $searchUse = 'use Illuminate\Support\ServiceProvider;';

        $register = "public function register(): void\n\t{\n\t\t{{ register }}";
        $boot = "public function boot(): void\n\t{\n\t\t{{ boot }}";
        $use = "use Illuminate\Support\ServiceProvider;\n{{ use }}";

        $search = [$searchRegister, $searchBoost, $searchUse];
        $replace = [$register, $boot, $use];
        $stub = str_replace($search, $replace, $stub);
    }

    /**
     * Replace the tags for the given stub.
     */
    protected function replaceTags(string &$stub, string $name): string
    {
        $namespace = $this->rootNamespace();
        $controllerNamespace = $this->assembleNamespace('controller', null, false);
        $controllerNamespace = "$namespace\\$controllerNamespace";

        if ($name == 'BroadcastServiceProvider') {
            $namespace = "$namespace\Providers";
        } elseif ($name == 'RouteServiceProvider') {
            $namespace = "$namespace\Providers";
        }

        $search = ['{{ namespace }}', '{{ class }}', '{{ slug }}', '{{ service }}', '{{ controller_namespace }}'];
        $replace = [$namespace, $name, Str::slug($this->serviceName), $this->serviceName, $controllerNamespace];

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
    protected function makeProviders(): array
    {
        $providers = [];
        $elements = Config::get('laraca.struct.microservice.elements');

        $stubPath = $this->getLaravelStub('provider');

        $serviceProviderName = Str::of($this->serviceName)->finish('ServiceProvider');
        $serviceProvider = $this->makeFile($serviceProviderName, $stubPath);

        $search = ['{{ register }}', '{{ boot }}', '{{ use }}'];

        $register = '';
        $boot = '';
        $use = '';

        if (in_array('route', $elements)) {
            $routeProvider = $this->makeFile('RouteServiceProvider', $stubPath);
            $routeBoot = $this->files->get(__DIR__.'/stubs/snippets/routeservice_boot.stub');

            $replace = ['', $routeBoot];
            $this->files->replaceInFile($search, $replace, $routeProvider);

            $register = $register.'$this->app->register(RouteServiceProvider::class);'."\n";
            $use = $use.'use '.$this->rootNamespace()."\Providers\RouteServiceProvider;\n";
            array_push($providers, $routeProvider);

            $this->makeFile('web', __DIR__.'/stubs/routes-web.stub');
            $this->makeFile('api', __DIR__.'/stubs/routes-api.stub');
        }

        if (in_array('channel', $elements)) {
            $broadcastProvider = $this->makeFile('BroadcastServiceProvider', $stubPath);
            $broadcastBoot = $this->files->get(__DIR__.'/stubs/snippets/broadcastservice_boot.stub');
            $broadcastUse = "use Illuminate\Support\Facades\Broadcast;";

            $replace = ['', $broadcastBoot, $broadcastUse];
            $this->files->replaceInFile($search, $replace, $broadcastProvider);

            $register = $register ? $register."\t\t" : $register;
            $register = $register.'$this->app->register(BroadcastServiceProvider::class);'."\n";
            $use = $use.'use '.$this->rootNamespace()."\Providers\BroadcastServiceProvider;\n";
            array_push($providers, $broadcastProvider);

            $this->makeFile('channels', __DIR__.'/stubs/routes-channels.stub');
        }

        if (in_array('view', $elements) || in_array('component', $elements)) {
            $register = $register ? $register."\n\n\t\t" : $register;
            $register = $register."View::addNamespace('".Str::slug($this->serviceName)."', realpath(__DIR__.'/../resources/views'));";
            $use = $use."use Illuminate\Support\Facades\View;\n";
        }

        array_push($providers, $serviceProvider);
        $replace = [$register, $boot, $use];
        $this->files->replaceInFile($search, $replace, $serviceProvider);

        return $providers;
    }

    /**
     * Get the destination class path.
     */
    protected function getPath(string $name): string
    {
        $name = Str::of($name)->replaceFirst($this->rootNamespace(), '')->replace('\\', '/');

        $path = $this->servicePath;

        if ($name == 'BroadcastServiceProvider' || $name == 'RouteServiceProvider') {
            $path = $path.'/Providers';
        }
        if ($name == 'web' || $name == 'api' || $name == 'channels') {
            $path = $path.'/routes';
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
