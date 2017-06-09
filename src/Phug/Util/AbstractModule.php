<?php

namespace Phug\Util;

/**
 * Abstract class AbstractModule.
 */
abstract class AbstractModule implements ModuleInterface
{
    /**
     * @var ModulesContainerInterface
     */
    private $parent;

    /**
     * @var bool
     */
    private $plugged = false;

    /**
     * Hook triggered when plugged to the parent with ->addModule.
     *
     * @param ModulesContainerInterface $parent
     */
    public function plug(ModulesContainerInterface $parent)
    {
        $this->parent = $parent;
        $this->plugged = true;
    }

    /**
     * Hook triggered when unplugged to the parent with ->removeModule.
     */
    public function unplug()
    {
        $this->plugged = false;
    }

    /**
     * @return bool
     */
    public function isPlugged()
    {
        return $this->plugged;
    }

    /**
     * @return ModulesContainerInterface
     */
    public function getParent()
    {
        return $this->parent;
    }
}
