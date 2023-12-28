<?php

namespace HandsomeBrown\Laraca\Commands;

use Illuminate\Foundation\Console\ProviderMakeCommand;

class MakeProviderCommand extends ProviderMakeCommand
{
    use LaracaCommand;

    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:provider';

    /**
     * getDefaultNamespace
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $this->getClassNamespace('provider');
    }
}
