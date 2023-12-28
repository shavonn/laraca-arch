<?php

namespace HandsomeBrown\Laraca\Concerns;

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
        $domainsEnabled = Config::get('laraca.domains.enabled');

        return $domainsEnabled;
    }

    /**
     * Domain parent dir
     */
    public static function domainParentDir(): string
    {
        $parentDir = Config::get('laraca.domains.parent_dir');

        return $parentDir;
    }

    /**
     * assembleRelativePath
     *
     * @param  string  $key
     * @param  bool  $full
     */
    public static function assembleRelativePath($key, $domain = null): string
    {
        [$pathArray, $root] = self::assemblePathArray($key, $domain);

        $path = implode('/', $pathArray);

        if ($root == 'app') {
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
    public static function assembleFullPath($key, $domain = null): string
    {
        [$pathArray, $root] = self::assemblePathArray($key, $domain);

        $path = implode('/', $pathArray);

        if ($root == 'app') {
            $path = app_path($path);
        } elseif ($root == 'base') {
            $path = base_path($path);
        }

        return $path;
    }

    /**
     * assembleNamespace
     *
     * @param  string  $key
     * @param  string  $domain
     */
    public static function assembleNamespace($key, $domain = null): string
    {
        [$pathArray, $root] = self::assemblePathArray($key, $domain);

        if ($key === 'test') {
            array_shift($pathArray);
        }

        $pathArray = array_map(function ($dir) {
            return ucfirst($dir);
        }, $pathArray);

        $namespace = implode('\\', $pathArray);

        if ($root == 'app') {
            $namespace = app()->getNamespace().$namespace;
        }

        return $namespace;
    }

    /**
     * assemblePathArray
     *
     * @param  string,string  $key
     */
    protected static function assemblePathArray($key, $domain = null): array
    {
        if (! Config::has('laraca.structure.'.$key)) {
            throw new InvalidConfigKeyException();
        }

        $path = [];
        $current = Config::get('laraca.structure.'.$key);
        $done = false;

        do {
            if (array_key_exists('path', $current)) {
                $path = array_merge(explode('/', $current['path']), $path);
            } else {
                // key config missing path or namespace value
                throw new MissingPathNamespaceKeyException();
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
                } elseif (Config::has('laraca.structure.'.$parentKey)) {
                    $current = Config::get('laraca.structure.'.$parentKey);
                } else {
                    // parent key not found in config
                    throw new InvalidConfigKeyException();
                }
            } else {
                // path has led up to parent never finding 'base' or 'app' as a root
                throw new MissingRootPathException();
            }

        } while ($done !== true);

        return [$path, $base];
    }
}
