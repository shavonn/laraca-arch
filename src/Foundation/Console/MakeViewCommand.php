<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use HandsomeBrown\Laraca\Console\Concerns\GeneratesClasses;
use Illuminate\Foundation\Console\ViewMakeCommand;

class MakeViewCommand extends ViewMakeCommand
{
    use GeneratesClasses;

    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:view';
}
