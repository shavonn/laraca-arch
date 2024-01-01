<?php

namespace HandsomeBrown\Laraca\Commands\Traits;

use Symfony\Component\Console\Input\InputOption;

trait Directable
{
    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        $options = parent::getOptions();

        if (self::domainsEnabled()) {
            $options = array_merge($options, [
                ['domain', 'dom', InputOption::VALUE_REQUIRED, 'The name of the domain.'],
            ]);
        }

        if (self::microservicesEnabled()) {
            $options = array_merge($options, [
                ['service', 'serv', InputOption::VALUE_REQUIRED, 'The name of the service.'],
            ]);
        }

        return $options;
    }
}