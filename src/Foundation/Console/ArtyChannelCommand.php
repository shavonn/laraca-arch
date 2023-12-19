<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ArtyChannelCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:channel';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return config('laraca.channel.namespace');
    }
}
