<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Foundation\Console\EventMakeCommand;

class ArtyEventCommand extends EventMakeCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:event';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return config('laraca.event.namespace');
    }
}
