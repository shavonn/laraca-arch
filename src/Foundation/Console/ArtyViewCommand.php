<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Foundation\Console\ViewMakeCommand;

class ArtyViewCommand extends ViewMakeCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:view';

    /**
     * Get the first view directory path from the application configuration.
     *
     * @param  string  $path
     * @return string
     */
    protected function viewPath($path = '')
    {
        $views = config('laraca.view.path') ?? resource_path('views');

        return $views.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}
