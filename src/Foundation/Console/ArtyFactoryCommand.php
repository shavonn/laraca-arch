<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Database\Console\Factories\FactoryMakeCommand;

class ArtyFactoryCommand extends FactoryMakeCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:factory';

    /**
     * Get the full namespace for a given class, without the class name.
     *
     * @param  string  $name
     * @return string
     */
    protected function getNamespace($name)
    {
        return config('laraca.factory.namespace');
    }
}
