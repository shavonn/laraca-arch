<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Database\Console\Factories\FactoryMakeCommand;

class ArtyFactoryCommand extends FactoryMakeCommand
{
    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:factory';

    /**
     * getNamespace
     * Get the full namespace for a given class, without the class name.
     *
     * @param  string  $name
     */
    protected function getNamespace($name): string
    {
        return config('laraca.factory.namespace');
    }
}
