<?php

namespace HandsomeBrown\Laraca\Traits;

use HandsomeBrown\Laraca\Exceptions\InvalidConfigKeyException;
use HandsomeBrown\Laraca\Exceptions\MissingPathNamespaceKeyException;
use HandsomeBrown\Laraca\Exceptions\MissingRootPathException;
use Illuminate\Support\Facades\Config;

trait GetsConfigValues
{
    /**
     * If domains are enabled
     */
    protected static function domainsEnabled(): bool
    {
        $domainsEnabled = Config::get('laraca.struct.domain.enabled');

        return $domainsEnabled;
    }

    /**
     * Domain parent dir
     */
    protected static function domainParentDir(): ?string
    {
        $parentDir = Config::get('laraca.struct.domain.path');

        return $parentDir;
    }

    /**
     * If microservices are enabled
     */
    protected static function microservicesEnabled(): bool
    {
        $microservicesEnabled = Config::get('laraca.struct.microservice.enabled');

        return $microservicesEnabled;
    }

    /**
     * Microservice parent dir
     */
    protected static function microserviceParentDir(): ?string
    {
        $parentDir = Config::get('laraca.struct.microservice.path');

        return $parentDir;
    }

    /**
     * Return namespace string
     */
    public static function getConfigNamespace(string $key, ?string $domain = null, ?string $service = null, bool $withRoot = true): string
    {
        $path = self::assemblePathArray($key, $domain, $service);
        $pathArray = $path->getArray();

        $pathArray = array_map(function ($dir) {
            return str_replace('/', '\\', ucfirst($dir));
        }, $pathArray);

        $namespace = implode('\\', $pathArray);

        if ($path->getRoot() == 'app' && $withRoot) {
            $namespace = app()->getNamespace().$namespace;
        }

        return $namespace;
    }

    /**
     * Return full path string
     */
    public static function getConfigPath(string $key, ?string $domain = null, ?string $service = null, bool $withRoot = true): string
    {
        $path = self::assemblePathArray($key, $domain, $service);
        $pathArray = $path->getArray();

        $pathStr = implode('/', $pathArray);

        if ($withRoot) {
            if ($path->getRoot() == 'app') {
                $pathStr = app_path($pathStr);
            } elseif ($path->getRoot() == 'base') {
                $pathStr = base_path($pathStr);
            }
        }

        return $pathStr;
    }

    /**
     * Return full path as array
     */
    protected static function assemblePathArray(string $key, ?string $domain = null, ?string $service = null): Path
    {
        if (! Config::has('laraca.struct.'.$key)) {
            throw new InvalidConfigKeyException($key);
        }

        $path = self::getBasePathArray($key);
        $pathArray = $path->getArray();

        if (self::microservicesEnabled() || self::domainsEnabled()) {
            if ($service || $domain) {
                if ($service) {
                    array_unshift($pathArray, ucfirst($service));

                    if (self::microserviceParentDir()) {
                        $parentDir = self::microserviceParentDir();
                        array_unshift($pathArray, ...explode('/', $parentDir));
                    }
                }

                if ($domain) {
                    array_unshift($pathArray, ucfirst($domain));

                    if (self::domainParentDir()) {
                        $parentDir = self::domainParentDir();
                        array_unshift($pathArray, ...explode('/', $parentDir));
                    }

                }

                if ($path->getRoot() == 'base') {
                    $path->setRoot('app');
                }
            }
        }

        return new Path($pathArray, $path->getRoot());
    }

    /**
     * Return base path string
     */
    public static function getBasePath(string $key): string
    {
        $path = self::getBasePathArray($key);
        $pathArray = $path->getArray();

        $pathStr = implode('/', $pathArray);

        return $pathStr;
    }

    /**
     * Return path as array without root
     */
    protected static function getBasePathArray(string $key): Path
    {
        if (! Config::has('laraca.struct.'.$key)) {
            throw new InvalidConfigKeyException($key);
        }

        $pathArray = [];
        $current = Config::get('laraca.struct.'.$key);
        $done = false;

        do {
            if (array_key_exists('path', $current)) {
                $pathArray = array_merge(explode('/', $current['path']), $pathArray);
            } else {
                // key config missing path or namespace value
                throw new MissingPathNamespaceKeyException($key);
            }

            if (array_key_exists('parent', $current) && (bool) $current['parent']) {
                $parentKey = $current['parent'];

                if ($parentKey == 'app' || $parentKey == 'base') {
                    $root = $parentKey;
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

        return new Path($pathArray, $root);
    }
}
