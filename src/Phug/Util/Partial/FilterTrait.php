<?php

namespace Phug\Util\Partial;

/**
 * Class FilterTrait
 * @package Phug\Util\Partial
 */
trait FilterTrait
{

    /**
     * @var string
     */
    private $filter = null;

    /**
     * @return string
     */
    public function getFilter()
    {

        return $this->filter;
    }

    /**
     * @param string $filter
     *
     * @return $this
     */
    public function setFilter($filter)
    {

        $this->filter = $filter;

        return $this;
    }
}
