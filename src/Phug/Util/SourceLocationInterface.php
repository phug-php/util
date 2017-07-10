<?php

namespace Phug\Util;

interface SourceLocationInterface extends DocumentLocationInterface
{

    /**
     * @return int
     */
    public function getOffsetLength();

    /**
     * @return string
     */
    public function getPath();
}
