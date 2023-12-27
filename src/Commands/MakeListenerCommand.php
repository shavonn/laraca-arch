<?php

namespace HandsomeBrown\Laraca\Commands;

use Illuminate\Foundation\Console\ListenerMakeCommand;

class MakeListenerCommand extends ListenerMakeCommand
{
    use LaracaCommand;

    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:listener';

    /**
     * getDefaultNamespace
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return self::assembleNamespace('listener');
    }
}
