<?php

namespace HandsomeBrown\Laraca\Console\Concerns;

trait Generates
{
    /**
     * viewPath
     * Get the first view directory path from the application configuration.
     *
     * @param  string  $path
     * @return string
     */
    protected function viewPath($path = '')
    {
        $views = base_path(config('laraca.view.path'));

        return $views.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}
