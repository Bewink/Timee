<?php

namespace vendor\befew;

/**
 * Class Path
 * @package vendor\befew
 */
class Path {
    private $path;

    /**
     * Constructor
     * @param $path
     */
    public function __construct($path) {
        $this->path = $path;
    }

    public function __toString() {
        return $this->getPath();
    }

    public function getPath() {
        return $this->path;
    }

    /**
     * @return mixed
     */
    public function getPathWithWebSeparators() {
        return str_replace('\\', '/', $this->getPath());
    }
}