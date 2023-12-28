<?php

namespace HandsomeBrown\Laraca\Commands;

use HandsomeBrown\Laraca\Concerns\GetsConfigValues;
use Symfony\Component\Console\Input\InputArgument;

trait LaracaCommand
{
    use GetsConfigValues;

    /**
     * Get the class namespace
     *
     * @param  string  $key
     */
    protected function getClassNamespace($key): string
    {
        $domain = $this->input->getArgument('domain');
        if (self::domainsEnabled() && $domain) {
            return self::assembleNamespace($key, $this->input->getArgument('domain'));
        }

        return self::assembleNamespace($key);
    }

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
