<?php

namespace Phug\Util;

/**
 * Interface DocumentLocationInterface
 * @package Phug\Util
 */
interface DocumentLocationInterface
{

    /**
     * @return int
     */
    public function getLine();

    /**
     * @return int
     */
    public function getOffset();
}
