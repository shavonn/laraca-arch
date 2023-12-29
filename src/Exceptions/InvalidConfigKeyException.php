<?php

namespace HandsomeBrown\Laraca\Exceptions;

use Exception;

class InvalidConfigKeyException extends Exception
{
    public function __construct($key)
    {
        $this->message = 'Invalid configuration key: '.$key;
    }
}
