<?php

namespace HandsomeBrown\Laraca\Commands;

use HandsomeBrown\Laraca\Concerns\GetsConfigValues;
use Illuminate\Foundation\Console\ConsoleMakeCommand;

class MakeCommandCommand extends ConsoleMakeCommand
{
    use GetsConfigValues;

    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:command';

    /**
     * getDefaultNamespace
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return self::assembleNamespace('command');
    }
}
