<?php

namespace HandsomeBrown\Laraca\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'init:structure')]
class InitStructureCommand extends LaracaGeneratorCommand
{
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
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle()
    {
        $config = Config::get('laraca.struct');

        $this->components->info('Creating directory structure from Laraca config.');

        foreach (array_keys($config) as $key) {
            if ($key == 'domain' && ! $config['domain']['enabled']) {
                continue;
            } elseif ($key == 'microservice' && ! $config['microservice']['enabled']) {
                continue;
            }

            $fullPath = self::assembleFullPath($key);

            $this->makeEmptyDirectory($fullPath);
        }

        $this->components->info('Configured structure generated successfully.');

        return Command::SUCCESS;
    }
}
