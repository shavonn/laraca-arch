<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Foundation\Console\ProviderMakeCommand;

class ArtyProviderCommand extends ProviderMakeCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:provider';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return config('laraca.provider.namespace');
    }
}
