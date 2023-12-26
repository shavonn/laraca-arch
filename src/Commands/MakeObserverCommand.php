<?php

namespace HandsomeBrown\Laraca\Commands;

use HandsomeBrown\Laraca\Concerns\GetsConfigValues;
use Illuminate\Foundation\Console\ObserverMakeCommand;

class MakeObserverCommand extends ObserverMakeCommand
{
    use GetsConfigValues;

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
