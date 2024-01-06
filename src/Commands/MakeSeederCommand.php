<?php

namespace HandsomeBrown\Laraca\Commands;

use HandsomeBrown\Laraca\Commands\Traits\Directable;
use HandsomeBrown\Laraca\Commands\Traits\SharedMethods;
use HandsomeBrown\Laraca\Commands\Traits\UsesLaravelGenerator;
use Illuminate\Database\Console\Seeds\SeederMakeCommand;
use Illuminate\Support\Str;

class MakeSeederCommand extends SeederMakeCommand
{
    use Directable, SharedMethods, UsesLaravelGenerator;

    /**
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

        return self::getFullPath('seeder')."/$name.php";
    }

    /**
     * Get the root namespace for the class.
     */
    protected function rootNamespace(): string
    {
        return $this->getFullNamespace('seeder');
    }
}
