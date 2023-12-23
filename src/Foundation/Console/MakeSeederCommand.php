<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use HandsomeBrown\Laraca\Console\Concerns\Generates;
use Illuminate\Database\Console\Seeds\SeederMakeCommand;
use Illuminate\Support\Str;

class MakeSeederCommand extends SeederMakeCommand
{
    use Generates;

    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:seeder';

    /**
     * getPath
     * Get the destination class path.
     *
     * @param  string  $name
     */
    protected function getPath($name): string
    {
        $name = str_replace('\\', '/', Str::replaceFirst($this->rootNamespace(), '', $name));

        return $this->laravel->databasePath().DIRECTORY_SEPARATOR.config('laraca.seeder.path').$name.'.php';
    }

    /**
     * rootNamespace
     * Get the root namespace for the class.
     */
    protected function rootNamespace(): string
    {
        return $this->getDatabaseNamespace(config('laraca.seeder.path'));
    }
}
