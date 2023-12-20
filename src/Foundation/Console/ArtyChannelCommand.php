<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Foundation\Console\ChannelMakeCommand;

class ArtyChannelCommand extends ChannelMakeCommand
{
    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:channel';

    /**
     * getDefaultNamespace
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return config('laraca.channel.namespace');
    }
}
