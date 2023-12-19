<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Foundation\Console\PolicyMakeCommand;

class ArtyPolicyCommand extends PolicyMakeCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:policy';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return config('laraca.policy.namespace');
    }
}