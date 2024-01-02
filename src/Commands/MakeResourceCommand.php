<?php

namespace HandsomeBrown\Laraca\Commands;

use HandsomeBrown\Laraca\Commands\Traits\Directable;
use HandsomeBrown\Laraca\Commands\Traits\LaracaCommand;
use Illuminate\Foundation\Console\ResourceMakeCommand;

class MakeResourceCommand extends ResourceMakeCommand
{
    use Directable, LaracaCommand;

    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:resource';

    /**
     * getDefaultNamespace
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $this->getFullNamespace('resource');
    }
}
