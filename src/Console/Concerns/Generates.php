<?php

namespace HandsomeBrown\Laraca\Console\Concerns;

use HandsomeBrown\Laraca\Exceptions\InvalidConfigKeyException;
use HandsomeBrown\Laraca\Exceptions\MissingPathNamespaceKeyException;
use HandsomeBrown\Laraca\Exceptions\MissingRootPathException;

trait Generates
{
    /**
     * replaceIn
     * Replace the given string in the given file.
     *
     * @param  string|array<string>  $search
     * @param  string|array<string>  $replace
     */
    protected function replaceIn(string $path, string|array $search, string|array $replace): void
    {
        if ($this->files->exists($path)) {
            $this->files->put($path, str_replace($search, $replace, $this->files->get($path)));
        }
    }

    /**
     * viewPath
     * Get the first view directory path from the application configuration.
     *
     * @param  string  $path
     * @return string
     */
    protected function viewPath($path = '')
    {
        $views = base_path(config('laraca.view.path'));

        return $views.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }

    /**
     * pathToNamespace
     */
    public function pathToNamespace(string $path): string
    {
        $strArry = explode('/', $path);
        $strArry = array_map(function ($str) {
            return ucfirst($str);
        }, $strArry);

        return implode('\\', $strArry);
    }

    /**
     * namespaceToPath
     */
    public function namespaceToPath(string $path): string
    {
        $strArry = explode('\\', $path);
        $strArry = array_map(function ($str) {
            return ucfirst($str);
        }, $strArry);

        return implode('/', $strArry);
    }

    /**
     * getDatabasePath
     *
     * @param  string  $path
     */
    protected function getDatabaseNamespace($path = ''): string
    {
        $path = config('laraca.database.path').($path ? DIRECTORY_SEPARATOR.$path : $path);

        return $this->pathToNamespace($path);
    }

    /**
     * buildPath
     *
     * @param  string  $key
     * @return array<string,string>
     */
    protected function buildPath($key): array
    {
        $path = [];
        $current = config('laraca.'.$key);
        $done = false;

        do {

            if (array_key_exists('path', $current)) {
                array_unshift($path, $current['path']);
            } elseif (array_key_exists('namespace', $current)) {
                array_unshift($path, $this->namespaceToPath($current['namespace']));
            } else {
                // key config missing path or namespace value
                throw new MissingPathNamespaceKeyException();
            }

            if (array_key_exists('parent', $current) && (bool) $current['parent']) {
                $parentKey = $current['parent'];

                if ($parentKey == 'app' || $parentKey == 'base') {
                    $path = implode('/', $path);
                    $done = true;

                    if ($parentKey == 'app') {
                        $path = [
                            'full' => app_path($path),
                            'relative' => 'app/'.$path,
                        ];
                    } elseif ($parentKey == 'base') {
                        $path = [
                            'full' => base_path($path),
                            'relative' => $path,
                        ];
                    }
                } elseif (array_key_exists($parentKey, config('laraca'))) {
                    $current = config('laraca.'.$parentKey);
                } else {
                    // parent key not found in config
                    throw new InvalidConfigKeyException();
                }
            } else {
                // path has led up to parent never finding 'base' or 'app' as a root
                throw new MissingRootPathException();
            }

        } while ($done !== true);

        return $path;
    }
}
