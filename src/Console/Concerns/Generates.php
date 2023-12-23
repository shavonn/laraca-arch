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
     * getStubPath
     * Return path to stub file.
     */
    public function getStubPath(string $stub): string
    {
        return __DIR__."/../../Foundation/Console/stubs/{$stub}";
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

    /**
     * pathToNamespace
     */
    public function pathToNamespace(string $path): string
    {
        $strArry = explode('/', $path);
        $strArry = array_map(function ($str) {
            return ucfirst($str);
        }, $strArry);

        return implode('\\', $strArry);
    }

    /**
     * getDatabasePath
     *
     * @param  string  $path
     */
    protected function getDatabaseNamespace($path = ''): string
    {
        $path = config('laraca.database.path').($path ? DIRECTORY_SEPARATOR.$path : $path);

        return $this->pathToNamespace($path);
    }
}
