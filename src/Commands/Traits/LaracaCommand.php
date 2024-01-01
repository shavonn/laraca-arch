<?php

namespace HandsomeBrown\Laraca\Commands\Traits;

use HandsomeBrown\Laraca\Traits\GetsConfigValues;

trait LaracaCommand
{
    use GetsConfigValues;

    public function hasParents()
    {
        return (bool) class_parents($this);
    }

    /**
     * Get the class name
     */
    protected function getClassName($name): string
    {
        $name = ltrim($name, '\\/');

        $name = str_replace('/', '\\', $name);

        return ucfirst($name);
    }

    /**
     * Get the namespace with the possibility of domain or service flags
     *
     * @param  string  $key
     */
    protected function getClassNamespace($key): string
    {
        if ($this->input->hasOption('domain')) {
            $domainName = $this->getClassName($this->input->getOption('domain'));
            if (self::domainsEnabled() && $domainName) {
                return self::assembleNamespace($key, $domainName);
            }
        }

        if ($this->input->hasOption('service')) {
            $serviceName = $this->getClassName($this->input->getOption('service'));
            if (self::microservicesEnabled() && $serviceName) {
                return self::assembleNamespace($key, null, $serviceName);
            }
        }

        return self::assembleNamespace($key);
    }

    /**
     * Get the path with the possibility of domain or service flags
     *
     * @param  string  $key
     */
    protected function getGenerationPath($key): string
    {
        if ($this->input->hasOption('domain')) {
            $domainName = $this->getClassName($this->input->getOption('domain'));
            if (self::domainsEnabled() && $domainName) {
                return self::assembleFullPath($key, $domainName);
            }
        }

        if ($this->input->hasOption('service')) {
            $serviceName = $this->getClassName($this->input->getOption('service'));
            if (self::microservicesEnabled() && $serviceName) {
                return self::assembleFullPath($key, null, $serviceName);
            }
        }

        return self::assembleFullPath($key);
    }
}
