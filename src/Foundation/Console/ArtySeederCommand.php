<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Database\Console\Seeds\SeederMakeCommand;
use Illuminate\Support\Str;

class ArtySeederCommand extends SeederMakeCommand
{
    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:seeder';

    /**
     * getPath
     * Get the destination class path.
     *
     * @param  string  $name
     */
    protected function getPath($name): string
    {
        $name = str_replace('\\', '/', Str::replaceFirst($this->rootNamespace(), '', $name));

        return config('laraca.seeder.path').$name.'.php';
    }

    /**
     * rootNamespace
     * Get the root namespace for the class.
     */
    protected function rootNamespace(): string
    {
        return config('laraca.seeder.namespace');
    }
}
