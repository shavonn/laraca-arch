<?php

namespace HandsomeBrown\Laraca\Commands;

use Illuminate\Foundation\Console\CastMakeCommand;

class MakeCastCommand extends CastMakeCommand
{
    use LaracaCommand;

    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:cast';

    /**
     * getDefaultNamespace
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return self::assembleNamespace('cast');
    }
}
