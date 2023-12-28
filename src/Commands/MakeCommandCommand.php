<?php

namespace HandsomeBrown\Laraca\Commands;

use Illuminate\Foundation\Console\ConsoleMakeCommand;

class MakeCommandCommand extends ConsoleMakeCommand
{
    use LaracaCommand;

    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:command';

    /**
     * getDefaultNamespace
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $this->getClassNamespace('command');
    }
}
