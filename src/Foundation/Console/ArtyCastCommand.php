<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Foundation\Console\CastMakeCommand;

class ArtyCastCommand extends CastMakeCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:cast';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return config('laraca.cast.namespace');
    }
}
