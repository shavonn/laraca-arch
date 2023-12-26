<?php

namespace HandsomeBrown\Laraca\Commands;

use HandsomeBrown\Laraca\Concerns\GetsConfigValues;
use Illuminate\Foundation\Console\ResourceMakeCommand;

class MakeResourceCommand extends ResourceMakeCommand
{
    use GetsConfigValues;

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
        return self::assembleNamespace('resource');
    }
}
