<?php

namespace HandsomeBrown\Laraca\Foundation\Console\Artisan;

use Illuminate\Foundation\Console\ConsoleMakeCommand;

class MakeCommandCommand extends ConsoleMakeCommand
{
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
        return $rootNamespace.'\\'.config('laraca.command.namespace');
    }
}
