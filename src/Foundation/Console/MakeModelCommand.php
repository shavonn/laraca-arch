<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use HandsomeBrown\Laraca\Console\Concerns\GeneratesClasses;
use Illuminate\Foundation\Console\ModelMakeCommand;
use Symfony\Component\Console\Input\InputOption;

class MakeModelCommand extends ModelMakeCommand
{
    use GeneratesClasses;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'arty:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent model class';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
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
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return config('laraca.model.namespace');
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array_merge(parent::getOptions(), [
            ['uuid', null, InputOption::VALUE_NONE, 'Create an Eloquent model with a uuid as the primary key.'],
        ]);
    }
}
