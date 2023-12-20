<?php

namespace HandsomeBrown\Laraca\Console\Concerns;

trait GeneratesClasses
{
    /**
     * Replace the given string in the given file.
     *
     * replaceIn
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
     * Return path to generated stub file.
     *
     * getGeneratedStubPath
     */
    public function getGeneratedStubPath(string $stub): string
    {
        return __DIR__."/../../Foundation/Console/stubs/generated/{$stub}";
    }

    /**
     * Return path to stub file.
     *
     * getStubPath
     */
    public function getStubPath(string $stub): string
    {
        return __DIR__."/../../Foundation/Console/stubs/{$stub}";
    }

    /**
     * Get the first view directory path from the application configuration.
     *
     * viewPath
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
