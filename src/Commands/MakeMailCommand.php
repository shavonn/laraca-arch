<?php

namespace HandsomeBrown\Laraca\Commands;

use HandsomeBrown\Laraca\Commands\Traits\Directable;
use HandsomeBrown\Laraca\Commands\Traits\LaracaCommand;
use Illuminate\Foundation\Console\MailMakeCommand;

class MakeMailCommand extends MailMakeCommand
{
    use Directable, LaracaCommand;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:mail';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $this->getFullNamespace('mail');
    }
}
