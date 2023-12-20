<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Foundation\Console\TestMakeCommand;
use Illuminate\Support\Str;

class ArtyTestCommand extends TestMakeCommand
{
    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:test';

    /**
     * getPath
     * Get the destination class path.
     *
     * @param  string  $name
     */
    protected function getPath($name): string
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return config('laraca.test.path').str_replace('\\', '/', $name).'.php';
    }

    /**
     * getDefaultNamespace
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        if ($this->option('unit')) {
            return config('laraca.test.namespace').'\Unit';
        } else {
            return config('laraca.test.namespace').'\Feature';
        }
    }
}
