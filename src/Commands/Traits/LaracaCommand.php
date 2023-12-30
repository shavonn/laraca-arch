<?php

namespace HandsomeBrown\Laraca\Commands\Traits;

use HandsomeBrown\Laraca\Traits\GetsConfigValues;

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
        if ($this->input->hasOption('domain')) {
            $domainName = ucfirst($this->input->getOption('domain'));
            if (self::domainsEnabled() && $domainName) {
                return self::assembleNamespace($key, $domainName);
            }
        }

        if ($this->input->hasOption('service')) {
            $serviceName = ucfirst($this->input->getOption('service'));
            if (self::microservicesEnabled() && $serviceName) {
                return self::assembleNamespace($key, null, $serviceName);
            }
        }

        return self::assembleNamespace($key);
    }
}
