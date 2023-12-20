<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Foundation\Console\RuleMakeCommand;

class ArtyRuleCommand extends RuleMakeCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:rule';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return config('laraca.rule.namespace');
    }
}
