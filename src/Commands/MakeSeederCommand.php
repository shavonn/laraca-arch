<?php

namespace HandsomeBrown\Laraca\Commands;

use HandsomeBrown\Laraca\Commands\Traits\LaracaCommand;
use Illuminate\Database\Console\Seeds\SeederMakeCommand;
use Illuminate\Support\Str;

class MakeSeederCommand extends SeederMakeCommand
{
    use LaracaCommand;

    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:seeder';

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     */
    protected function getPath($name): string
    {
        $name = Str::of($name)->replaceFirst($this->rootNamespace(), '')->replace('\\', '/');

        return self::assembleFullPath('seeder')."/$name.php";
    }

    /**
     * rootNamespace
     * Get the root namespace for the class.
     */
    protected function rootNamespace(): string
    {
        return $this->getClassNamespace('seeder');
    }
}
