<?php

namespace HandsomeBrown\Laraca\Foundation\Console\Artisan;

use Illuminate\Foundation\Console\ResourceMakeCommand;

class MakeResourceCommand extends ResourceMakeCommand
{
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
        return $rootNamespace.'\\'.config('laraca.resource.namespace');
    }
}
