<?php

namespace HandsomeBrown\Laraca\Commands;

use HandsomeBrown\Laraca\Commands\Traits\LaracaCommand;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

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
     * Generated files.
     *
     * @var array
     */
    protected $generated = [];

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
     * Execute the console command.
     *
     * @return bool|null
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        if ((! $this->hasOption('force') ||
                ! $this->option('force')) &&
            $this->alreadyExists($this->input->getArgument('name'))
        ) {
            $this->components->error($this->type.' already exists.');

            return false;
        }

        return true;
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

        $content = $this->replaceTags($stub, $name);
        $this->files->put($path, $content);

        array_push($this->generated, $path);

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
     * Get the destination class path.
     */
    protected function getPath(string $name): string
    {
        $name = Str::of($name)->replaceFirst($this->rootNamespace(), '')->replace('\\', '/');

        return self::assembleFullPath($this->key)."/$name.php";
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $this->getFullNamespace($this->key);
    }

    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName)
    {
        return $this->files->exists($this->getPath($this->getClassName($rawName)));
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return $this->laravel->getNamespace();
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['force', 'f', InputOption::VALUE_NONE, 'Create the '.strtolower($this->type).' even if it already exists'],
        ];
    }
}
