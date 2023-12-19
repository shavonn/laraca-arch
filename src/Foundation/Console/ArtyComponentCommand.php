<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Foundation\Console\ComponentMakeCommand;

class ArtyComponentCommand extends ComponentMakeCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:component';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return config('laraca.component.namespace');
    }
}
