<?php

namespace HandsomeBrown\Laraca\Commands;

use HandsomeBrown\Laraca\Commands\Traits\Directable;
use HandsomeBrown\Laraca\Commands\Traits\LaracaCommand;
use Illuminate\Foundation\Console\ListenerMakeCommand;

class MakeListenerCommand extends ListenerMakeCommand
{
    use Directable, LaracaCommand;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:listener';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $this->getFullNamespace('listener');
    }
}
