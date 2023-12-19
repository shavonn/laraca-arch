<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Foundation\Console\ListenerMakeCommand;

class ArtyListenerCommand extends ListenerMakeCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:listener';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return config('laraca.listener.namespace');
    }
}
