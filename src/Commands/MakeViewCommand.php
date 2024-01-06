<?php

namespace HandsomeBrown\Laraca\Commands;

use HandsomeBrown\Laraca\Commands\Traits\CreatesView;
use HandsomeBrown\Laraca\Commands\Traits\Directable;
use HandsomeBrown\Laraca\Commands\Traits\LaracaCommand;
use Illuminate\Foundation\Console\ViewMakeCommand;

class MakeViewCommand extends ViewMakeCommand
{
    use CreatesView;
    use Directable, LaracaCommand;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:view';

    /**
     * Create the matching test case if requested.
     *
     * @param  string  $path
     */
    protected function handleTestCreation($path): bool
    {
        return parent::handleTestCreation($path);
    }
}
