<?php

namespace Phug\Util\Partial;

/**
 * Class NameTrait
 * @package Phug\Util\Partial
 */
trait NameTrait
{

    /**
     * @var string
     */
    private $name = null;

    /**
     * @return string
     */
    public function getName()
    {

        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {

        $this->name = $name;

        return $this;
    }
}
