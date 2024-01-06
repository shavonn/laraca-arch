<?php

namespace HandsomeBrown\Laraca\Traits;

class Path
{
    /**
     * Path as array
     *
     * @var array<string>
     */
    protected $pathArray = [];

    /**
     * Path root name
     *
     * @var string
     */
    protected $root = '';

    /**
     * @param  array<string>  $pathArray
     * @param  string  $root
     */
    public function __construct($pathArray, $root)
    {
        $this->pathArray = $pathArray ? $pathArray : [];
        $this->root = $root;
    }

    /**
     * Return path array
     *
     * @return array<string>
     */
    public function getArray(): array
    {
        return $this->pathArray;
    }

    /**
     * Return root
     */
    public function getRoot(): string
    {
        return $this->root;
    }

    /**
     * Update root
     */
    public function setRoot(string $root): string
    {
        return $this->root = $root;
    }
}
