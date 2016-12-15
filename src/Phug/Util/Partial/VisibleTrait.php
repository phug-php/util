<?php

namespace Phug\Util\Partial;

/**
 * Class VisibleTrait
 * @package Phug\Util\Partial
 */
trait VisibleTrait
{

    /**
     * @var bool
     */
    private $visible = true;

    /**
     * @return bool
     */
    public function isVisible()
    {

        return $this->visible;
    }

    /**
     * @param bool $visible
     * @return $this
     */
    public function setIsVisible($visible)
    {

        $this->visible = $visible;

        return $this;
    }

    /**
     * @return $this
     */
    public function show()
    {

        $this->visible = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function hide()
    {

        $this->visible = false;

        return $this;
    }
}
