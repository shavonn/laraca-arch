<?php

namespace HandsomeBrown\Laraca\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'make:enum')]
class MakeEnumCommand extends GeneratorCommand
{
    use LaracaCommand;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:enum';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new enumeration class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Enum';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/enum.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $this->getClassNamespace('enum');
    }
}
