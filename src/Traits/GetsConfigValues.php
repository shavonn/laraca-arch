<?php

namespace HandsomeBrown\Laraca\Traits;

use HandsomeBrown\Laraca\Exceptions\InvalidConfigKeyException;
use HandsomeBrown\Laraca\Exceptions\MissingPathNamespaceKeyException;
use HandsomeBrown\Laraca\Exceptions\MissingRootPathException;
use Illuminate\Support\Facades\Config;

trait GetsConfigValues
{
    /**
     * Using domains
     */
    public static function domainsEnabled(): bool
    {
        $domainsEnabled = Config::get('laraca.struct.domain.enabled');

        return $domainsEnabled;
    }

    /**
     * Domain parent dir
     */
    public static function domainParentDir(): ?string
    {
        $parentDir = Config::get('laraca.struct.domain.path');

        return $parentDir;
    }

    /**
     * Using domains
     */
    public static function microservicesEnabled(): bool
    {
        $microservicesEnabled = Config::get('laraca.struct.microservice.enabled');

        return $microservicesEnabled;
    }

    /**
     * Domain parent dir
     */
    public static function microserviceParentDir(): ?string
    {
        $parentDir = Config::get('laraca.struct.microservice.path');

        return $parentDir;
    }

    /**
     * assembleRelativePath
     */
    public static function assembleRelativePath(string $key, ?string $domain = null, ?string $service = null, bool $withRoot = true): string
    {
        [$pathArray, $root] = self::assemblePathArray($key, $domain, $service);

        $path = implode('/', $pathArray);

        if ($root == 'app' && $withRoot) {
            $path = 'app/'.$path;
        }

        return $path;
    }

    /**
     * assembleFullPath
     */
    public static function assembleFullPath(string $key, ?string $domain = null, ?string $service = null, bool $withRoot = true): string
    {
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

    /**
     * assembleNamespace
     */
    public static function assembleNamespace(string $key, ?string $domain = null, ?string $service = null, bool $withRoot = true): string
    {
        [$pathArray, $root] = self::assemblePathArray($key, $domain, $service);

        if ($key === 'test') {
            array_shift($pathArray);
        }

        $pathArray = array_map(function ($dir) {
            return ucfirst($dir);
        }, $pathArray);

        $namespace = implode('\\', $pathArray);

        if ($root == 'app' && $withRoot) {
            $namespace = app()->getNamespace().$namespace;
        }

        return $namespace;
    }

    /**
     * assemblePathArray
     */
    protected static function assemblePathArray(string $key, ?string $domain = null, ?string $service = null): array
    {
        if (! Config::has('laraca.struct.'.$key)) {
            throw new InvalidConfigKeyException($key);
        }

        $path = [];
        $current = Config::get('laraca.struct.'.$key);
        $done = false;

        do {
            if (array_key_exists('path', $current)) {
                $path = array_merge(explode('/', $current['path']), $path);
            } else {
                // key config missing path or namespace value
                throw new MissingPathNamespaceKeyException($key);
            }

            if (array_key_exists('parent', $current) && (bool) $current['parent']) {
                $parentKey = $current['parent'];

                if ($parentKey == 'app' || $parentKey == 'base') {

                    if (self::domainsEnabled() && $domain) {
                        array_unshift($path, ucfirst($domain));

                        if (self::domainParentDir()) {
                            array_unshift($path, self::domainParentDir());
                        }
                    }

                    if (self::microservicesEnabled() && $service) {
                        array_unshift($path, ucfirst($service));

                        if (self::microserviceParentDir()) {
                            array_unshift($path, self::microserviceParentDir());
                        }
                    }

                    $base = $parentKey;
                    $done = true;
                } elseif (Config::has('laraca.struct.'.$parentKey)) {
                    $current = Config::get('laraca.struct.'.$parentKey);
                } else {
                    // parent key not found in config
                    throw new InvalidConfigKeyException($parentKey);
                }
            } else {
                // path has led up to parent never finding 'base' or 'app' as a root
                throw new MissingRootPathException($key);
            }

        } while ($done !== true);

        return [$path, $base];
    }
}
