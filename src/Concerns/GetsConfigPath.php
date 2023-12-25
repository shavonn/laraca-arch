<?php

namespace HandsomeBrown\Laraca\Concerns;

use HandsomeBrown\Laraca\Exceptions\InvalidConfigKeyException;
use HandsomeBrown\Laraca\Exceptions\MissingPathNamespaceKeyException;
use HandsomeBrown\Laraca\Exceptions\MissingRootPathException;

trait GetsConfigPath
{
    /**
     * assemblePath
     *
     * @param  string  $key
     * @return array<string,string>
     */
    protected function assemblePath($key): array
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
