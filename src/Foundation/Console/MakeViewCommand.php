<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use HandsomeBrown\Laraca\Console\Concerns\Generates;
use Illuminate\Foundation\Console\ViewMakeCommand;

class MakeViewCommand extends ViewMakeCommand
{
    use Generates;

    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:view';
}
