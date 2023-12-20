<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Foundation\Console\JobMakeCommand;

class ArtyJobCommand extends JobMakeCommand
{
    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:job';

    /**
     * getDefaultNamespace
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return config('laraca.job.namespace');
    }
}
