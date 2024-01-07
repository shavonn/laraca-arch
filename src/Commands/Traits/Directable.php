<?php

namespace HandsomeBrown\Laraca\Commands\Traits;

use Symfony\Component\Console\Input\InputOption;

trait Directable
{
    /**
     * Add the domain and service options where applicable
     *
     * @return void
     */
    protected function addDirectableOptions()
    {
        if (self::domainsEnabled()) {
            $this->getDefinition()->addOption(new InputOption(
                'domain', 'dom', InputOption::VALUE_REQUIRED,
                "The name of the domain {$this->type} will be added to."
            ));
        }

        if (self::microservicesEnabled() && $this->type !== 'Microservice') {
            $this->getDefinition()->addOption(new InputOption(
                'service', 'serv', InputOption::VALUE_REQUIRED,
                "The name of the service {$this->type} will be added to."
            ));
        }
    }
}
