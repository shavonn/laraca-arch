<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Routing\Console\ControllerMakeCommand;

class ArtyControllerCommand extends ControllerMakeCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:controller';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return config('laraca.controller.namespace');
    }
}
