<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Foundation\Console\ExceptionMakeCommand;

class ArtyExceptionCommand extends ExceptionMakeCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:exception';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return config('laraca.exception.namespace');
    }
}
