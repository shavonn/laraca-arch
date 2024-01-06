<?php

namespace HandsomeBrown\Laraca\Commands;

use HandsomeBrown\Laraca\Commands\Traits\CreatesView;
use HandsomeBrown\Laraca\Commands\Traits\Directable;
use HandsomeBrown\Laraca\Commands\Traits\Shared;
use Illuminate\Foundation\Console\ViewMakeCommand;
use Illuminate\Support\Str;

class MakeViewCommand extends ViewMakeCommand
{
    use CreatesView, Directable, Shared;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:view';

    /**
     * Create the matching test case if requested.
     *
     * @param  string  $path
     */
    protected function handleTestCreation($path): bool
    {
        return parent::handleTestCreation($path);
    }

    /**
     * Get the class fully qualified name for the test.
     *
     * @return string
     */
    protected function testClassFullyQualifiedName()
    {
        $extension = is_string($this->option('extension')) ? $this->option('extension') : '';
        $name = Str::of(Str::lower($this->getNameInput()))->replace('.'.$extension, '');

        $namespacedName = Str::of(
            Str::of($name)
                ->replace('/', ' ')
                ->explode(' ')
                ->map(fn ($part) => Str::of($part)->ucfirst())
                ->implode('\\')
        )
            ->replace(['-', '_'], ' ')
            ->explode(' ')
            ->map(fn ($part) => Str::of($part)->ucfirst())
            ->implode('');

        return $this->getConfigNamespaceWithOptions('test').'\\Feature\\View\\'.$namespacedName;
    }
}
