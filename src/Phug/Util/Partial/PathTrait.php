<?php

namespace Phug\Util\Partial;

/**
 * Class PathTrait
 * @package Phug\Util\Partial
 */
trait PathTrait
{

    /**
     * @var string
     */
    private $path = null;

    /**
     * @return string
     */
    public function getPath()
    {

        return $this->path;
    }

    /**
     * @param string $path
     *
     * @return $this
     */
    public function setPath($path)
    {

        $this->path = $path;

        return $this;
    }
}
