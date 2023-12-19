<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Foundation\Console\ResourceMakeCommand;

class ArtyResourceCommand extends ResourceMakeCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:resource';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return config('laraca.resource.namespace');
    }
}