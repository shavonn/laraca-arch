<?php

namespace HandsomeBrown\Laraca\Concerns;

trait CreatesView
{
    /**
     * viewPath
     * Get the first view directory path from the application configuration.
     *
     * @param  string  $path
     * @return string
     */
    protected function viewPath($path = '')
    {
        $views = parent::viewPath($path);

        try {
            $laracaViewsPath = $this->assemblePath('view');
            $this->components->info('Using laraca.view config path.');
            $views = $laracaViewsPath;
        } catch (\Throwable $th) {
            $this->components->info('Using config.view config path.');
        }

        return $views.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}
