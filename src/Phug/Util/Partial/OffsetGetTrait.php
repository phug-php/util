<?php

namespace Phug\Util\Partial;

/**
 * Class OffsetGetTrait
 * @package Phug\Util\Partial
 */
trait OffsetGetTrait
{

    /**
     * @var int
     */
    private $offset = null;

    /**
     * @return int
     */
    public function getOffset()
    {

        return $this->offset;
    }
}
