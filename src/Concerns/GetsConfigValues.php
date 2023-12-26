<?php

namespace HandsomeBrown\Laraca\Concerns;

use HandsomeBrown\Laraca\Exceptions\InvalidConfigKeyException;
use HandsomeBrown\Laraca\Exceptions\MissingPathNamespaceKeyException;
use HandsomeBrown\Laraca\Exceptions\MissingRootPathException;
use Illuminate\Support\Facades\Config;

trait GetsConfigValues
{
    /**
     * assemblePath
     *
     * @param  string  $key
     * @param  bool  $full
     */
    public static function assemblePath($key, $full = true): string
    {
        [$pathArray, $root] = self::assemblePathArray($key);

        $path = implode('/', $pathArray);

        if ($root == 'app') {
            $path = $full ? app_path($path) : 'app/'.$path;
        } elseif ($root == 'base') {
            $path = $full ? base_path($path) : $path;
        }

        return $path;
    }

    /**
     * assembleNamespace
     *
     * @param  string  $key
     * @param  bool  $full
     */
    public static function assembleNamespace($key): string
    {
        [$pathArray, $root] = self::assemblePathArray($key);

        $pathArray = array_map(function ($dir) {
            return ucfirst($dir);
        }, $pathArray);

        $path = implode('\\', $pathArray);

        if ($root == 'app') {
            $path = app()->getNamespace().$path;
        }

        return $path;
    }

    /**
     * assemblePathArray
     *
     * @param  string,string  $key
     */
    protected static function assemblePathArray($key): array
    {
        if (! Config::has('laraca.'.$key)) {
            throw new InvalidConfigKeyException();
        }

        $path = [];
        $current = Config::get('laraca.'.$key);
        $done = false;
        $base = 'base';

        do {
            if (array_key_exists('path', $current)) {
                $path = array_merge(explode('/', $current['path']), $path);
            } elseif (array_key_exists('namespace', $current)) {
                $path = array_merge(explode('\\', $current['namespace']), $path);
            } else {
                // key config missing path or namespace value
                throw new MissingPathNamespaceKeyException();
            }

            if (array_key_exists('parent', $current) && (bool) $current['parent']) {
                $parentKey = $current['parent'];

                if ($parentKey == 'app' || $parentKey == 'base') {
                    $base = $parentKey;
                    $done = true;
                } elseif (Config::has('laraca.'.$parentKey)) {
                    $current = Config::get('laraca.'.$parentKey);
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
