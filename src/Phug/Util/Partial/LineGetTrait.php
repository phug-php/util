<?php

namespace Phug\Util\Partial;

/**
 * Class LineGetTrait
 * @package Phug\Util\Partial
 */
trait LineGetTrait
{

    /**
     * @var int
     */
    private $line = null;

    /**
     * @return int
     */
    public function getLine()
    {

        return $this->line;
    }
}
