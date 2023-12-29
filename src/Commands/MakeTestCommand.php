<?php

namespace HandsomeBrown\Laraca\Commands;

use HandsomeBrown\Laraca\Commands\Traits\Domainable;
use HandsomeBrown\Laraca\Commands\Traits\LaracaCommand;
use Illuminate\Foundation\Console\TestMakeCommand;
use Illuminate\Support\Str;

class MakeTestCommand extends TestMakeCommand
{
    use Domainable, LaracaCommand;

    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:test';

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     */
    protected function getPath($name): string
    {
        $name = Str::of($name)->replaceFirst($this->rootNamespace(), '')->replace('\\', '/');

        return self::assembleFullPath('test')."/$name.php";
    }
}
