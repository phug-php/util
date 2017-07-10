<?php

namespace Phug\Util\Partial;

trait SourceLocationTrait
{
    use DocumentLocationTrait;
    use PathGetTrait;

    /**
     * @var int
     */
    private $offsetLength = 0;

    /**
     * @return int
     */
    public function getOffsetLength()
    {
        return $this->offsetLength;
    }
}
