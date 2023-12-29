<?php

namespace HandsomeBrown\Laraca\Commands\Traits;

use HandsomeBrown\Laraca\Traits\GetsConfigValues;

trait LaracaCommand
{
    use GetsConfigValues;

    /**
     * Get the class namespace
     *
     * @param  string  $key
     */
    protected function getClassNamespace($key): string
    {
        if ($this->input->hasArgument('domain')) {
            $domain = ucfirst($this->input->getArgument('domain'));
            if (self::domainsEnabled() && $domain) {
                return self::assembleNamespace($key, $domain);
            }
        }

        return self::assembleNamespace($key);
    }
}
