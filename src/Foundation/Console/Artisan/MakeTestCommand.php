<?php

namespace HandsomeBrown\Laraca\Foundation\Console\Artisan;

use HandsomeBrown\Laraca\Console\Concerns\GeneratesClasses;
use Illuminate\Foundation\Console\TestMakeCommand;
use Illuminate\Support\Str;

class MakeTestCommand extends TestMakeCommand
{
    use GeneratesClasses;

    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:test';

    /**
     * getPath
     * Get the destination class path.
     *
     * @param  string  $name
     */
    protected function getPath($name): string
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return base_path(config('laraca.test.path')).str_replace('\\', '/', $name).'.php';
    }

    /**
     * rootNamespace
     * Get the root namespace for the class.
     */
    protected function rootNamespace(): string
    {
        return $this->pathToNamespace(config('laraca.test.path'));
    }
}
