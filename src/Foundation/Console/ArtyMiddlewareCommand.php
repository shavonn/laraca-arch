<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Routing\Console\MiddlewareMakeCommand;

class ArtyMiddlewareCommand extends MiddlewareMakeCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:middleware';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return config('laraca.middleware.namespace');
    }
}
