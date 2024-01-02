<?php

namespace HandsomeBrown\Laraca\Commands;

use HandsomeBrown\Laraca\Commands\Traits\Directable;
use HandsomeBrown\Laraca\Commands\Traits\LaracaCommand;
use Illuminate\Foundation\Console\ModelMakeCommand;
use Symfony\Component\Console\Input\InputOption;

class MakeModelCommand extends ModelMakeCommand
{
    use Directable, LaracaCommand;

    /**
     * name
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:model';

    /**
     * getStub
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        $stub = parent::getStub();

        if ($this->option('uuid')) {
            $uuidStubPath = __DIR__.'/stubs/generated/model-uuid.stub';

            if (! file_exists($uuidStubPath)) {
                copy($stub, $uuidStubPath);

                $search = [
                    'use Illuminate\Database\Eloquent\Model;',
                    'use HasFactory;',
                ];

                $replace = [
                    "use Illuminate\Database\Eloquent\Traits\HasUuids;\nuse Illuminate\Database\Eloquent\Model;\n",
                    "use HasFactory, HasUuids;\n",
                ];

                $this->files->replaceInFile($search, $replace, $uuidStubPath);
            }

            return $uuidStubPath;
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
        return $this->getFullNamespace('model');
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
