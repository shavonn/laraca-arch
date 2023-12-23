<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use HandsomeBrown\Laraca\Console\Concerns\Generates;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'make:structure')]
class MakeStructureCommand extends Command
{
    use Generates;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:structure';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new structure object class';

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
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle()
    {
        $config = config('laraca');
        $messages = [];

        $this->components->info('Creating directy structure from Laraca config.');

        foreach (array_keys($config) as $key) {
            $paths = $this->buildPath($key);

            if (! $this->files->isDirectory($paths['full'])) {
                $this->files->makeDirectory($paths['full'], 0777, true, true);
                $state = 'created';
            } else {
                $state = ' already exists';
            }
            array_push($messages, sprintf('Directory [%s] %s.', $paths['relative'], $state));
        }

        $this->components->bulletList($messages);
        $this->components->info('Configured structure generated successfully.');

        return Command::SUCCESS;
    }
}
