<?php

namespace HandsomeBrown\Laraca\Commands;

use HandsomeBrown\Laraca\Commands\Traits\Domainable;
use HandsomeBrown\Laraca\Commands\Traits\LaracaCommand;
use Illuminate\Console\Concerns\CreatesMatchingTest;
use Illuminate\Support\Str;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;

#[AsCommand(name: 'make:service')]
class MakeServiceCommand extends LaracaGeneratorCommand
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
        $name = $this->getClassName($this->input->getArgument('name'));
        $name = Str::of($name)->endsWith('Service') ? $name : Str::of($name)->finish('Service');

        $interface = Str::of($name)->finish('Interface');

        $interfacePath = $this->makeFile($interface, __DIR__.'/stubs/interface.stub');
        $servicePath = $this->makeFile($name, __DIR__.'/stubs/service.stub');

        $info = $this->type;

        if (in_array(CreatesMatchingTest::class, class_uses_recursive($this))) {
            if ($this->handleTestCreation($servicePath)) {
                $info .= ' and test';
            }
        }

        if (windows_os()) {
            $servicePath = str_replace('/', '\\', $servicePath);
        }

        $this->components->info(sprintf('%s [%s] and interface [%s] created successfully.', $info, $servicePath, $interfacePath));
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
        $interface = Str::of($name)->finish('Interface');

        $search = ['{{ namespace }}', '{{ class }}', '{{ interface }}'];
        $replace = [$this->assembleNamespace('service'), $name, $interface];

        $stub = str_replace($search, $replace, $stub);

        return $stub;
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
