<?php

namespace HandsomeBrown\Laraca\Commands;

use HandsomeBrown\Laraca\Commands\Traits\Directable;
use HandsomeBrown\Laraca\Commands\Traits\LaracaCommand;
use Illuminate\Database\Console\Migrations\MigrateMakeCommand;
use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Support\Composer;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'arti:migration')]
class ArtiMigrationCommand extends MigrateMakeCommand
{
    use Directable, LaracaCommand;

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'arti:migration {name : The name of the migration}
        {--create= : The table to be created}
        {--table= : The table to migrate}
        {--path= : The location where the migration file should be created}
        {--realpath : Indicate any provided migration file paths are pre-resolved absolute paths}
        {--fullpath : Output the full path of the migration (Deprecated)}';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Migration';

    /**
     * Create a new migration install command instance.
     *
     * @return void
     */
    public function __construct(MigrationCreator $creator, Composer $composer)
    {
        if (self::domainsEnabled()) {
            $this->signature = $this->signature.' {--domain= : The name of the domain}';
        }

        if (self::microservicesEnabled()) {
            $this->signature = $this->signature.' {--service= : The name of the service}';
        }

        parent::__construct($creator, $composer);
    }

    /**
     * Get migration path (either specified by '--path' option or default location).
     */
    protected function getMigrationPath(): string
    {
        [$domain, $service] = $this->gatherPathAssets();

        if (! is_null($targetPath = $this->input->getOption('path'))) {
            return ! $this->usingRealPath()
                            ? $this->laravel->basePath().'/'.$targetPath
                            : $targetPath;
        }

        return self::assembleFullPath('migration', $domain, $service);
    }
}
