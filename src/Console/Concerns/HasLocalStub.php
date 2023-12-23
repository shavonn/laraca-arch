<?php

namespace HandsomeBrown\Laraca\Console\Concerns;

trait HasLocalStub
{
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
