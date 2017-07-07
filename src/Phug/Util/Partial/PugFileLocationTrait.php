<?php

namespace Phug\Util\Partial;

trait PugFileLocationTrait
{
    /**
     * @var string
     */
    private $pugFile;

    /**
     * @var int
     */
    private $pugLine;

    /**
     * @var int
     */
    private $pugOffset;

    /**
     * @param string $pugFile
     *
     * @return $this
     */
    public function setPugFile($pugFile)
    {
        $this->pugFile = $pugFile;

        return $this;
    }

    /**
     * @return string
     */
    public function getPugFile()
    {
        return $this->pugFile;
    }

    /**
     * @param int $pugLine
     *
     * @return $this
     */
    public function setPugLine($pugLine)
    {
        $this->pugLine = $pugLine;

        return $this;
    }

    /**
     * @return int
     */
    public function getPugLine()
    {
        return $this->pugLine;
    }

    /**
     * @param int $pugOffset
     *
     * @return $this
     */
    public function setPugOffset($pugOffset)
    {
        $this->pugOffset = $pugOffset;

        return $this;
    }

    /**
     * @return int
     */
    public function getPugOffset()
    {
        return $this->pugOffset;
    }
}
