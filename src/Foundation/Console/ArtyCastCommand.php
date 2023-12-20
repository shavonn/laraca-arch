<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Foundation\Console\CastMakeCommand;

class ArtyCastCommand extends CastMakeCommand
{
    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:cast';

    /**
     * getDefaultNamespace
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return config('laraca.cast.namespace');
    }
}
