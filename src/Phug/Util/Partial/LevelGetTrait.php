<?php

namespace Phug\Util\Partial;

/**
 * Class LevelGetTrait
 * @package Phug\Util\Partial
 */
trait LevelGetTrait
{

    /**
     * @var int
     */
    private $level = 0;

    /**
     * @return int
     */
    public function getLevel()
    {

        return $this->level;
    }
}
