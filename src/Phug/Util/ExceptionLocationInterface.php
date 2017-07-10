<?php

namespace Phug\Util;

interface ExceptionLocationInterface extends DocumentLocationInterface
{
    /**
     * @return string
     */
    public function getPath();
}
