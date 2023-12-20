<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Foundation\Console\ObserverMakeCommand;

class ArtyObserverCommand extends ObserverMakeCommand
{
    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:observer';

    /**
     * getDefaultNamespace
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return config('laraca.observer.namespace');
    }
}
