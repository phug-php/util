<?php

namespace Phug\Util\Partial;

use SplObjectStorage;

/**
 * Class AttributeTrait
 * @package Phug\Util\Partial
 */
trait AttributeTrait
{

    /**
     * @var SplObjectStorage
     */
    private $attributes = null;

    /**
     * @return SplObjectStorage
     */
    public function getAttributes()
    {

        if (!$this->attributes) {
            $this->attributes = new SplObjectStorage;
        }

        return $this->attributes;
    }
}
