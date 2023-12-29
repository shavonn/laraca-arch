<?php

namespace HandsomeBrown\Laraca\Commands\Traits;

use Symfony\Component\Console\Input\InputArgument;

trait Domainable
{
    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        if (self::domainsEnabled()) {
            return array_merge(parent::getArguments(), [
                ['domain', InputArgument::OPTIONAL, 'The name of the domain.'],
            ]);
        }

        return parent::getArguments();
    }
}
