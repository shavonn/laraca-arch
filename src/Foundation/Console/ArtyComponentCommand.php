<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use HandsomeBrown\Laraca\Console\Concerns\GeneratesClasses;
use Illuminate\Foundation\Console\ComponentMakeCommand;

class ArtyComponentCommand extends ComponentMakeCommand
{
    use GeneratesClasses;

    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:component';

    /**
     * getDefaultNamespace
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return strval(config('laraca.component.namespace'));
    }
}
