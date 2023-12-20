<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use HandsomeBrown\Laraca\Console\Concerns\GeneratesClasses;
use Illuminate\Foundation\Console\ModelMakeCommand;
use Symfony\Component\Console\Input\InputOption;

class ArtyModelCommand extends ModelMakeCommand
{
    use GeneratesClasses;

    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:model';

    /**
     * getStub
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        $stub = parent::getStub();

        if ($this->option('uuid')) {
            $uuidStubPath = $this->getGeneratedStubPath('model-uuid.stub');

            if (! file_exists($uuidStubPath)) {
                copy($stub, $uuidStubPath);

                $search = [
                    'use Illuminate\Database\Eloquent\Model;',
                    'use HasFactory;',
                ];

                $replace = [
                    "use Illuminate\Database\Eloquent\Concerns\HasUuids;\nuse Illuminate\Database\Eloquent\Model;\n",
                    "use HasFactory, HasUuids;\n",
                ];

                $this->replaceIn($uuidStubPath, $search, $replace);
            }

            $stub = $uuidStubPath;
        }

        return $stub;
    }

    /**
     * getDefaultNamespace
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return config('laraca.model.namespace');
    }

    /**
     * getOptions
     * Get the console command options.
     *
     * @return array<array<string>>
     */
    protected function getOptions(): array
    {
        return array_merge(parent::getOptions(), [
            ['uuid', null, InputOption::VALUE_NONE, 'Create an Eloquent model with a uuid as the primary key.'],
        ]);
    }
}
