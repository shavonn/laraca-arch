<?php

namespace HandsomeBrown\Laraca\Commands\Traits;

trait CreatesView
{
    /**
     * Get the first view directory path from the application configuration.
     * Laravel func
     *
     * @param  string  $path
     * @return string
     */
    protected function viewPath($path = '')
    {
        $views = parent::viewPath($path);

        try {
            $laracaViewsPath = $this->getFullPath('view');
            $views = $laracaViewsPath.'/'.$path;
        } catch (\Throwable $th) {
            $this->components->info('Using config.view config path.');
        }

        return $views;
    }
}
