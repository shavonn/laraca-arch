<?php

namespace HandsomeBrown\Laraca\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Finder\Finder as SymfonyFinder;

#[AsCommand(name: 'domain:list')]
class DomainListCommand extends Command
{
    use LaracaCommand;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'domain:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all domains.';

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
        $domains = [];

        $domainDir = Config::get('laraca.domains.parent_dir');
        $domainPath = app_path($domainDir);

        if ($this->files->isDirectory($domainPath)) {
            $finder = new SymfonyFinder();

            foreach ($finder->directories()->depth('== 0')->in($domainPath)->directories() as $dir) {
                $name = $dir->getRelativePathName();

                array_push($domains, [
                    'name' => $name,
                    'slug' => Str::snake($name),
                    'path' => "app/$domainDir/$name",
                ]);
            }
        }

        $this->table(['Domain', 'Slug', 'Path'], array_map(function ($domain) {
            return [$domain['name'], $domain['slug'], $domain['path']];
        }, $domains));

        return Command::SUCCESS;
    }
}
