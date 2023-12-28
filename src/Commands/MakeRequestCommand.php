<?php

namespace HandsomeBrown\Laraca\Commands;

use Illuminate\Foundation\Console\RequestMakeCommand;

class MakeRequestCommand extends RequestMakeCommand
{
    use LaracaCommand;

    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:request';

    /**
     * getDefaultNamespace
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $this->getClassNamespace('request');
    }
}
