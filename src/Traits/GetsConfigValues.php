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
     * assembleRelativePath
     *
     * @param  string  $key
     * @param  bool  $full
     */
    public static function assembleRelativePath($key, $domain = null, $withRoot = true): string
    {
        [$pathArray, $root] = self::assemblePathArray($key, $domain);

        $path = implode('/', $pathArray);

        if ($root == 'app' && $withRoot) {
            $path = 'app/'.$path;
        }

        return $path;
    }

    /**
     * assembleFullPath
     *
     * @param  string  $key
     * @param  string  $domain
     */
    public static function assembleFullPath($key, $domain = null, $withRoot = true): string
    {
        [$pathArray, $root] = self::assemblePathArray($key, $domain);

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
     *
     * @param  string  $key
     * @param  string  $domain
     */
    public static function assembleNamespace($key, $domain = null, $withRoot = true): string
    {
        [$pathArray, $root] = self::assemblePathArray($key, $domain);

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
     *
     * @param  string  $key
     */
    protected static function assemblePathArray($key, $domain = null): array
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
