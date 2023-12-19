<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Console\Command;

class ArtyCommandCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:command';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return config('laraca.command.namespace');
    }
}
