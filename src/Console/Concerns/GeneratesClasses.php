<?php

namespace HandsomeBrown\Laraca\Console\Concerns;

trait GeneratesClasses
{
    /**
     * Replace the given string in the given file.
     */
    protected function replaceIn(string $path, string|array $search, string|array $replace): void
    {
        if ($this->files->exists($path)) {
            $this->files->put($path, str_replace($search, $replace, $this->files->get($path)));
        }
    }

    /**
     * Return path to generated stub file.
     */
    public function getGeneratedStubPath(string $stub): string
    {
        return __DIR__."/../../Foundation/Console/stubs/generated/{$stub}";
    }

    /**
     * Return path to stub file.
     */
    public function getStubPath(string $stub): string
    {
        return __DIR__."/../../Foundation/Console/stubs/{$stub}";
    }
}
