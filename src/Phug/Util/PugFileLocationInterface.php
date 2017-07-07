<?php

namespace Phug\Util;

interface PugFileLocationInterface
{
    /**
     * @return string
     */
    public function getPugFile();

    /**
     * @return int
     */
    public function getPugLine();

    /**
     * @return int
     */
    public function getPugOffset();
}
