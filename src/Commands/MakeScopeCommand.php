<?php

namespace HandsomeBrown\Laraca\Commands;

use Illuminate\Foundation\Console\ScopeMakeCommand;

class MakeScopeCommand extends ScopeMakeCommand
{
    use LaracaCommand;

    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:scope';

    /**
     * getDefaultNamespace
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $this->getClassNamespace('scope');
    }
}
