<?php

namespace HandsomeBrown\Laraca\Commands;

use HandsomeBrown\Laraca\Commands\Traits\Directable;
use HandsomeBrown\Laraca\Commands\Traits\LaracaCommand;
use Illuminate\Console\Concerns\CreatesMatchingTest;
use Illuminate\Support\Str;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;

#[AsCommand(name: 'make:strategy')]
class MakeStrategyCommand extends LaracaGeneratorCommand
{
    use Directable, LaracaCommand;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:strategy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new strategy class and interface';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Strategy';

    /**
     * Execute the console command.
     *
     * @return bool|void
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $name = $this->getClassName($this->input->getArgument('name'));

        if (! parent::handle()) {
            return false;
        }

        $concreteName = Str::of($name)->start('Type');

        $interfacePath = $this->makeFile($name, __DIR__.'/stubs/interface.stub');
        $strategyPath = $this->makeFile($concreteName, __DIR__.'/stubs/implements-interface.stub');

        $info = $this->type;

        if (in_array(CreatesMatchingTest::class, class_uses_recursive($this))) {
            if ($this->handleTestCreation($strategyPath)) {
                $info .= ' and test';
            }
        }

        if (windows_os()) {
            $strategyPath = str_replace('/', '\\', $strategyPath);
        }

        $this->components->info(sprintf('%s [%s] and interface [%s] created successfully.', $info, $strategyPath, $interfacePath));
    }

    /**
     * Get the class name
     */
    protected function getClassName(string $name): string
    {
        $name = parent::getClassName($name);

        return Str::of($name)->endsWith('Strategy') ? $name : Str::of($name)->finish('Strategy');
    }

    /**
     * Replace the tags for the given stub.
     */
    protected function replaceTags(string &$stub, string $name): string
    {
        [$domain, $service] = $this->gatherPathAssets();

        $concreteStrategy = Str::of($name)->start('Type');

        $search = ['{{ namespace }}', '{{ class }}', '{{ interface }}'];
        $replace = [$this->assembleNamespace('strategy'), $concreteStrategy, $name];

        $stub = str_replace($search, $replace, $stub);

        return $stub;
    }

    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName)
    {
        $name = $this->getClassName($rawName);
        $strategyName = Str::of($name)->endsWith('Strategy') ? $name : Str::of($name)->finish('Strategy');

        return $this->files->exists($this->getPath($strategyName));
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
