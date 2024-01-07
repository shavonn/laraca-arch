<?php

namespace HandsomeBrown\Laraca\Commands\Traits;

use HandsomeBrown\Laraca\Traits\GetsConfigValues;
use Illuminate\Console\Concerns\CreatesMatchingTest;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

trait Shared
{
    use GetsConfigValues;

    /**
     * Config key.
     *
     * @var string
     */
    protected $configKey;

    /**
     * Create a new controller creator command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct(...func_get_args());

        $this->configKey = strtolower($this->type);
        $this->files = $files;

        if (in_array(CreatesMatchingTest::class, class_uses_recursive($this))) {
            $this->addTestOptions();
        }

        if (in_array(Directable::class, class_uses_recursive($this))) {
            $this->addDirectableOptions();
        }
    }

    /**
     * Get the class name
     */
    protected function formatName(string $name): string
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
    protected function getPathAssets(): array
    {
        $domain = null;
        $service = null;

        if ($this->input->hasOption('domain')) {
            $domain = $this->input->getOption('domain');
            $domainName = $domain ? $this->formatName($this->input->getOption('domain')) : null;
            if (self::domainsEnabled() && $domainName) {
                $domain = $domainName;
            }
        }

        if ($this->input->hasOption('service')) {
            $service = $this->input->getOption('service');
            $serviceName = $service ? $this->formatName($this->input->getOption('service')) : null;
            if (self::microservicesEnabled() && $serviceName) {
                $service = $serviceName;
            }
        }

        return [$domain, $service];
    }

    /**
     * Get the namespace with the possibility of domain or service flags
     */
    protected function getConfigNamespaceWithOptions(string $key, bool $withRoot = true): string
    {
        [$domain, $service] = $this->getPathAssets();

        return $this->getConfigNamespace($key, $domain, $service, $withRoot);
    }

    /**
     * Get the path with the possibility of domain or service flags
     */
    protected function getConfigPathWithOptions(string $key, bool $withRoot = true): string
    {
        [$domain, $service] = $this->getPathAssets();

        return self::getConfigPath($key, $domain, $service, $withRoot);
    }

    /**
     * Create the matching test case if requested.
     *
     * @param  string  $path
     * @return bool
     */
    protected function makeTest($path)
    {
        if (! $this->option('test') && ! $this->option('pest')) {
            return false;
        }

        $filename = Str::of(basename($path))->remove('.php')->finish('Test');

        $args = [
            'name' => $filename,
            '--pest' => $this->option('pest'),
        ];

        [$domain, $service] = $this->getPathAssets();

        if ($domain) {
            $args['--domain'] = $domain;
        }

        if ($service) {
            $args['--service'] = $service;
        }

        return $this->callSilent('make:test', $args) == 0;
    }
}
