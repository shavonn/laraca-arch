<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Routing\Console\MiddlewareMakeCommand;

class MakeMiddlewareCommand extends MiddlewareMakeCommand
{
    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:middleware';

    /**
     * getDefaultNamespace
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return config('laraca.middleware.namespace');
    }
}
