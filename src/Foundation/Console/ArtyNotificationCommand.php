<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Foundation\Console\NotificationMakeCommand;

class ArtyNotificationCommand extends NotificationMakeCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:notification';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return config('laraca.notification.namespace');
    }
}
