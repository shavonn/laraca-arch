<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Database\Console\Migrations\MigrateMakeCommand;

class ArtyMigrationCommand extends MigrateMakeCommand
{
    /**
     * signature
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'arty:migration {name : The name of the migration}
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
        return config('laraca.migration.path');
    }
}
