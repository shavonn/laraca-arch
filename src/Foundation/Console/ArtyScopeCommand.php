<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Foundation\Console\ScopeMakeCommand;

class ArtyScopeCommand extends ScopeMakeCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:scope';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return config('laraca.scope.namespace');
    }
}
