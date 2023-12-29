<?php

namespace HandsomeBrown\Laraca\Commands;

use HandsomeBrown\Laraca\Commands\Traits\LaracaCommand;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Config;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'init:structure')]
class InitStructureCommand extends Command
{
    use LaracaCommand;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'init:structure';

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
        $config = Config::get('laraca.structure');
        $messages = [];

        $this->components->info('Creating directory structure from Laraca config.');

        foreach (array_keys($config) as $key) {
            $fullPath = self::assembleFullPath($key);
            $relativePath = self::assembleRelativePath($key);

            if (! $this->files->isDirectory($fullPath)) {
                $this->files->makeDirectory($fullPath, 0777, true, true);
                $state = 'created';
            } else {
                $state = ' already exists';
            }

            if ($this->files->isEmptyDirectory($fullPath)) {
                $this->files->put($fullPath.'/.gitkeep', '');
            }

            array_push($messages, sprintf('[%s] %s.', $relativePath, $state));
        }

        $this->components->bulletList($messages);
        $this->components->info('Configured structure generated successfully.');

        return Command::SUCCESS;
    }
}
