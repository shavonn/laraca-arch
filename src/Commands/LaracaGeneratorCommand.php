<?php

namespace HandsomeBrown\Laraca\Commands;

use HandsomeBrown\Laraca\Commands\Traits\LaracaCommand;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class LaracaGeneratorCommand extends Command
{
    use LaracaCommand;

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Create a new controller creator command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Get the class name
     */
    protected function getClassName($name): string
    {
        $name = ltrim($name, '\\/');

        $name = str_replace('/', '\\', $name);

        return ucfirst($name);
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }

        return $path;
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @param  string  $stub
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function build($name, $stub)
    {
        $stub = $this->files->get($stub);

        return $this->replaceNamespace($stub, $name);
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @param  string  $stub
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function makeFile($name, $stub)
    {
        $path = $this->getPath($name);
        $this->makeDirectory($path);

        $stub = $this->files->get($stub);

        $content = $this->replaceNamespace($stub, $name);
        $this->files->put($path, $content);

        return $path;
    }
}
