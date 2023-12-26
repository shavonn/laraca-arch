<?php

namespace HandsomeBrown\Laraca\Commands;

use HandsomeBrown\Laraca\Concerns\GetsConfigValues;
use Illuminate\Foundation\Console\CastMakeCommand;

class MakeCastCommand extends CastMakeCommand
{
    use GetsConfigValues;

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
