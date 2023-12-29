<?php

namespace HandsomeBrown\Laraca\Commands\Traits;

trait HasLocalStub
{
    /**
     * getStubPath
     * Return path to stub file.
     */
    public function getStubPath(string $stub): string
    {
        return __DIR__."/../../Foundation/Console/stubs/{$stub}";
    }

    /**
     * resolveStubPath
     * Resolve the fully-qualified path to the stub.
     *
     * @param  string  $stub
     */
    protected function resolveLaracaStubPath($stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__.'/../../Foundation/Console'.$stub;
    }
}
