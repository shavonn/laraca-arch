<?php

namespace HandsomeBrown\Laraca\Commands;

use Illuminate\Foundation\Console\ChannelMakeCommand;

class MakeChannelCommand extends ChannelMakeCommand
{
    use LaracaCommand;

    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:channel';

    /**
     * getDefaultNamespace
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $this->getClassNamespace('channel');
    }
}
