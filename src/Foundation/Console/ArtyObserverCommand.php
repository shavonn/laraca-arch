<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Foundation\Console\ObserverMakeCommand;

class ArtyObserverCommand extends ObserverMakeCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:observer';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return config('laraca.observer.namespace');
    }
}
