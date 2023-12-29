<?php

namespace HandsomeBrown\Laraca\Commands;

use HandsomeBrown\Laraca\Commands\Traits\LaracaCommand;
use HandsomeBrown\Laraca\Exceptions\StubNotFoundException;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

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
     * The type of class being generated.
     *
     * @var string
     */
    protected $type;

    /**
     * Config key.
     *
     * @var string
     */
    protected $key;

    /**
     * Create a new controller creator command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->key = strtolower($this->type);

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
        if (! $this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeEmptyDirectory($path)
    {
        $this->makeDirectory($path);

        if ($this->files->isEmptyDirectory($path)) {
            $this->files->put($path.'/.gitkeep', '');
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
        $this->makeDirectory(dirname($path));

        $stub = $this->files->get($stub);

        $this->addAdditionalTags($stub);

        $content = $this->replaceTags($stub, $name);
        $this->files->put($path, $content);

        return $path;
    }

    /**
     * Replace the tags for the given stub.
     */
    protected function replaceTags(string &$stub, string $name): string
    {
        $search = ['{{ namespace }}', '{{ class }}'];
        $replace = [$this->assembleNamespace($this->key), $name];

        $stub = str_replace($search, $replace, $stub);

        return $stub;
    }

    /**
     * Add additional template tags
     */
    protected function addAdditionalTags(string &$stub): void
    {
    }

    /**
     * Get Laravel stub path
     */
    protected function getLaravelStub(string $stub): string
    {
        switch ($stub) {
            case 'provider':
                return __DIR__.'/../../vendor/laravel/framework/src/Illuminate/Foundation/Console/stubs/provider.stub';

            default:
                throw new StubNotFoundException();
        }
    }

    /**
     * Get the destination class path.
     */
    protected function getPath(string $name): string
    {
        $name = Str::of($name)->replaceFirst($this->rootNamespace(), '')->replace('\\', '/');

        return self::assembleFullPath($this->key)."/$name.php";
    }

    /**
     * rootNamespace
     * Get the root namespace for the class.
     */
    protected function rootNamespace(): string
    {
        return $this->getClassNamespace($this->key);
    }
}
