<?php

namespace Phug\Util\Partial;

/**
 * Class ModeTrait
 * @package Phug\Util\Partial
 */
trait ModeTrait
{

    /**
     * @var string
     */
    private $mode = null;

    /**
     * @return string
     */
    public function getMode()
    {

        return $this->mode;
    }

    /**
     * @param string $mode
     * @return $this
     */
    public function setMode($mode)
    {

        $this->mode = $mode;

        return $this;
    }
}
