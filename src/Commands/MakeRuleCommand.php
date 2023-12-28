<?php

namespace HandsomeBrown\Laraca\Commands;

use Illuminate\Foundation\Console\RuleMakeCommand;

class MakeRuleCommand extends RuleMakeCommand
{
    use LaracaCommand;

    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:rule';

    /**
     * getDefaultNamespace
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $this->getClassNamespace('rule');
    }
}