<?php

namespace HandsomeBrown\Laraca\Commands;

use Illuminate\Foundation\Console\ObserverMakeCommand;

class MakeObserverCommand extends ObserverMakeCommand
{
    use LaracaCommand;

    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:observer';

    /**
     * getDefaultNamespace
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return self::assembleNamespace('observer');
    }
}
