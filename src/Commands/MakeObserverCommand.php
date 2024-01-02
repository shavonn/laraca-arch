<?php

namespace HandsomeBrown\Laraca\Commands;

use HandsomeBrown\Laraca\Commands\Traits\Directable;
use HandsomeBrown\Laraca\Commands\Traits\LaracaCommand;
use Illuminate\Foundation\Console\ObserverMakeCommand;

class MakeObserverCommand extends ObserverMakeCommand
{
    use Directable, LaracaCommand;

    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:observer';

    /**
     * getDefaultNamespace
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $this->getFullNamespace('observer');
    }
}
