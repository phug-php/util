<?php

namespace Phug\Util;

use Phug\Util\Partial\ExceptionLocationTrait;

class ExceptionLocation implements ExceptionLocationInterface
{
    use ExceptionLocationTrait;

    public function __construct($path, $line, $offset)
    {
        $this->path = $path;
        $this->line = $line;
        $this->offset = $offset;
    }
}
