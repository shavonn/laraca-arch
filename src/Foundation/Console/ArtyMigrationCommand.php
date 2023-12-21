<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Database\Console\Migrations\MigrateMakeCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ArtyMigrationCommand extends MigrateMakeCommand
{
    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:migration';

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
        $this->input->setOption('path', config('laraca.migration.path'));

        return parent::getMigrationPath();
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the migration'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['create', null, InputOption::VALUE_REQUIRED, 'The table to be created', null],
            ['table', null, InputOption::VALUE_REQUIRED, 'The table to migrate', null],
            ['path', null, InputOption::VALUE_REQUIRED, 'The location where the migration file should be created', null],
            ['realpath', null, InputOption::VALUE_NONE, 'Indicate any provided migration file paths are pre-resolved absolute paths', null],
            ['fullpath', null, InputOption::VALUE_NONE, 'Output the full path of the migration (Deprecated)', null],
        ];
    }
}
