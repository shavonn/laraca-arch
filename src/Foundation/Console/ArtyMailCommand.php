<?php

namespace HandsomeBrown\Laraca\Foundation\Console;

use Illuminate\Foundation\Console\MailMakeCommand;

class ArtyMailCommand extends MailMakeCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'arty:mail';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return config('laraca.mail.namespace');
    }
}
