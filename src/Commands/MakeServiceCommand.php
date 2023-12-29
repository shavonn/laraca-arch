<?php

namespace HandsomeBrown\Laraca\Commands;

use HandsomeBrown\Laraca\Commands\Traits\Domainable;
use HandsomeBrown\Laraca\Commands\Traits\LaracaCommand;
use Illuminate\Console\Concerns\CreatesMatchingTest;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'make:service')]
class MakeServiceCommand extends GeneratorCommand
{
    use Domainable, LaracaCommand;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class and interface';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Service';

    /**
     * Execute the console command.
     *
     * @return bool|null
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        if ($this->isReservedName($this->getNameInput())) {
            $this->components->error('The name "'.$this->getNameInput().'" is reserved by PHP.');

            return false;
        }

        $name = $this->getServiceName();
        $interface = Str::of($name)->finish('Interface');

        $servicePath = $this->getPath($name);
        $interfacePath = $this->getPath($interface);

        $this->makeDirectory($servicePath);
        $this->files->put($servicePath, $this->sortImports($this->build($name, $this->getStub())));

        $this->makeDirectory($interfacePath);
        $this->files->put($interfacePath, $this->sortImports($this->build($interface, __DIR__.'/stubs/interface.stub')));

        $info = $this->type;

        if (in_array(CreatesMatchingTest::class, class_uses_recursive($this))) {
            if ($this->handleTestCreation($servicePath)) {
                $info .= ' and test';
            }
        }

        if (windows_os()) {
            $path = str_replace('/', '\\', $servicePath);
        }

        $this->components->info(sprintf('%s [%s] and interface [%s] created successfully.', $info, $servicePath, $interfacePath));
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/service.stub';
    }

    /**
     * Get the destination class path.
     */
    protected function getServiceName(): string
    {
        $name = $this->qualifyClass(ucfirst($this->input->getArgument('name')));

        return Str::of($name)->endsWith('Service') ? $name : Str::of($name)->finish('Service');
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     */
    protected function getPath($name): string
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return self::assembleFullPath('service').Str::replace('\\', '/', $name).'.php';
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @param  string  $stub
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function build($name, $stub)
    {
        $stub = $this->files->get($stub);

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        parent::replaceNamespace($stub, $name);

        $interface = Str::of($name)->replaceFirst($this->rootNamespace(), '')->replace('\\', '')->finish('Interface');
        $stub = str_replace('{{ interface }}', $interface, $stub);

        return $this;
    }

    /**
     * rootNamespace
     * Get the root namespace for the class.
     */
    protected function rootNamespace(): string
    {
        return $this->getClassNamespace('service');
    }
}
