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
     * Get domain and service values
     */
    protected function gatherPathAssets(): array
    {
        $domain = null;
        $service = null;

        if ($this->input->hasOption('domain')) {
            $domainName = $this->getClassName($this->input->getOption('domain'));
            if (self::domainsEnabled() && $domainName) {
                $domain = $domainName;
            }
        }

        if ($this->input->hasOption('service')) {
            $serviceName = $this->getClassName($this->input->getOption('service'));
            if (self::microservicesEnabled() && $serviceName) {
                $service = $serviceName;
            }
        }

        return [$domain, $service];
    }

    /**
     * Get the namespace with the possibility of domain or service flags
     *
     * @param  string  $key
     */
    protected function getFullNamespace($key): string
    {
        [$domain, $service] = $this->gatherPathAssets();

        return self::assembleNamespace($key, $domain, $service);
    }

    /**
     * Get the path with the possibility of domain or service flags
     *
     * @param  string  $key
     */
    protected function getBasePath($key): string
    {
        return self::assembleBasePath($key);
    }

    /**
     * Get the path with the possibility of domain or service flags
     */
    public function getFullPath(string $key, bool $withRoot = true): string
    {
        [$domain, $service] = $this->gatherPathAssets();

        [$pathArray, $root] = self::assemblePathArray($key, $domain, $service);

        $path = implode('/', $pathArray);

        if ($withRoot) {
            if ($root == 'app') {
                $path = app_path($path);
            } elseif ($root == 'base') {
                $path = base_path($path);
            }
        }

        return $path;
    }
}
