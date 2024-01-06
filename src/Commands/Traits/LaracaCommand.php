<?php

namespace HandsomeBrown\Laraca\Commands\Traits;

use HandsomeBrown\Laraca\Traits\GetsConfigValues;
use Illuminate\Support\Str;

trait LaracaCommand
{
    use GetsConfigValues;

    /**
     * Parse the class name and format according to the root namespace.
     * Laravel func
     *
     * @param  string  $name
     * @return string
     */
    protected function qualifyClass($name)
    {
        $name = ucfirst($name);

        return parent::qualifyClass($name);
    }

    /**
     * Get the class name
     */
    protected function getClassName(string $name): string
    {
        $name = ltrim($name, '\\/');

        $name = str_replace('/', '\\', $name);

        return ucfirst($name);
    }

    /**
     * Get domain and service values
     *
     * @return array<int,string|null>
     */
    protected function gatherPathAssets(): array
    {
        $domain = null;
        $service = null;

        if ($this->input->hasOption('domain')) {
            $domain = $this->input->getOption('domain');
            $domainName = $domain ? $this->getClassName($this->input->getOption('domain')) : null;
            if (self::domainsEnabled() && $domainName) {
                $domain = $domainName;
            }
        }

        if ($this->input->hasOption('service')) {
            $service = $this->input->getOption('service');
            $serviceName = $service ? $this->getClassName($this->input->getOption('service')) : null;
            if (self::microservicesEnabled() && $serviceName) {
                $service = $serviceName;
            }
        }

        return [$domain, $service];
    }

    /**
     * Get the namespace with the possibility of domain or service flags
     */
    protected function getFullNamespace(string $key): string
    {
        [$domain, $service] = $this->gatherPathAssets();

        return self::assembleNamespace($key, $domain, $service);
    }

    /**
     * Get the path with the possibility of domain or service flags
     */
    protected function getBasePath(string $key): string
    {
        return self::assembleBasePath($key);
    }

    /**
     * Get the path with the possibility of domain or service flags
     */
    public function getFullPath(string $key, bool $withRoot = true): string
    {
        [$domain, $service] = $this->gatherPathAssets();

        return self::assembleFullPath($key, $domain, $service, $withRoot);
    }

    /**
     * Create the matching test case if requested.
     * Laravel func
     *
     * @param  string  $path
     * @return bool
     */
    protected function handleTestCreation($path)
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
