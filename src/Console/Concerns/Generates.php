<?php

namespace HandsomeBrown\Laraca\Console\Concerns;

trait Generates
{
    /**
     * replaceIn
     * Replace the given string in the given file.
     *
     * @param  string|array<string>  $search
     * @param  string|array<string>  $replace
     */
    protected function replaceIn(string $path, string|array $search, string|array $replace): void
    {
        if ($this->files->exists($path)) {
            $this->files->put($path, str_replace($search, $replace, $this->files->get($path)));
        }
    }

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
