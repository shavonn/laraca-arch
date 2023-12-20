<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Foundation\Console\ConsoleMakeCommand;

class ArtyCommandCommand extends ConsoleMakeCommand
{
    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:command';

    /**
     * getDefaultNamespace
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return config('laraca.command.namespace');
    }
}
