<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Routing\Console\ControllerMakeCommand;

class MakeControllerCommand extends ControllerMakeCommand
{
    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:controller';

    /**
     * getDefaultNamespace
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return config('laraca.controller.namespace');
    }
}
