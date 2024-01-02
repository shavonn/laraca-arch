<?php

namespace HandsomeBrown\Laraca\Commands\Traits;

use HandsomeBrown\Laraca\Traits\GetsConfigValues;
use Illuminate\Support\Str;

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
    public function getFullPath(string $key, $withRoot = true): string
    {
        [$domain, $service] = $this->gatherPathAssets();

        return self::assembleFullPath($key, $domain, $service, $withRoot);
    }

    /**
     * Create the matching test case if requested.
     *
     * @param  string  $path
     */
    protected function handleTestCreation($path): bool
    {
        if (! $this->option('test') && ! $this->option('pest')) {
            return false;
        }

        $filename = Str::of(basename($path))->remove('.php')->finish('Test');

        $args = [
            'name' => $filename,
            '--pest' => $this->option('pest'),
        ];

        [$domain, $service] = $this->gatherPathAssets();

        if ($domain) {
            $args['--domain'] = $domain;
        }

        if ($service) {
            $args['--service'] = $service;
        }

        return $this->callSilent('make:test', $args) == 0;
    }
}
