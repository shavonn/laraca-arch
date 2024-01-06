<?php

namespace HandsomeBrown\Laraca\Commands;

use HandsomeBrown\Laraca\Commands\Traits\Directable;
use HandsomeBrown\Laraca\Commands\Traits\SharedMethods;
use HandsomeBrown\Laraca\Commands\Traits\UsesLaravelGenerator;
use Illuminate\Foundation\Console\NotificationMakeCommand;

class MakeNotificationCommand extends NotificationMakeCommand
{
    use Directable, SharedMethods, UsesLaravelGenerator;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:notification';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $this->getFullNamespace('notification');
    }

    /**
     * Create the matching test case if requested.
     *
     * @param  string  $path
     * @return bool
     */
    protected function handleTestCreation($path)
    {
        return $this->makeTest($path);
    }
}
