<?php

namespace HandsomeBrown\Laraca\Commands\Traits;

trait UsesLaravelGenerator
{
    /**
     * Parse the class name and format according to the root namespace.
     * Laravel func
     *
     * @param  string  $name
     * @return string
     */
    protected function qualifyClass($name)
    {
        $name = ucfirst($name);

        return parent::qualifyClass($name);
    }
}
