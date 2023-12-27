<?php

namespace HandsomeBrown\Laraca\Commands;

use Illuminate\Database\Console\Migrations\MigrateMakeCommand;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'arti:migration')]
class ArtiMigrationCommand extends MigrateMakeCommand
{
    use LaracaCommand;

    /**
     * signature
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
     * getMigrationPath
     * Get migration path (either specified by '--path' option or default location).
     */
    protected function getMigrationPath(): string
    {
        if (! is_null($targetPath = $this->input->getOption('path'))) {
            return ! $this->usingRealPath()
                            ? $this->laravel->basePath().'/'.$targetPath
                            : $targetPath;
        }

        return self::assemblePath('migration');
    }
}
