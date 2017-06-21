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
     * @var array[callable]
     */
    private $plugCallback = [];

    /**
     * @var array[callable]
     */
    private $unplugCallback = [];

    /**
     * Hook triggered when plugged to the parent with ->addModule.
     *
     * @param ModulesContainerInterface $parent
     *
     * @return $this
     */
    public function plug(ModulesContainerInterface $parent)
    {
        $this->parent = $parent;
        $this->plugged = true;

        foreach ($this->plugCallback as $callback) {
            $callback($parent);
        }
    }

    /**
     * Hook triggered when unplugged to the parent with ->removeModule.
     *
     * @return $this
     */
    public function unplug()
    {
        $this->plugged = false;

        foreach ($this->unplugCallback as $callback) {
            $callback($this->parent);
        }
    }

    /**
     * Add a listener on plug event.
     *
     * @param callable $handler
     *
     * @return callable remove listener callback
     */
    public function onPlug(callable $handler)
    {
        $this->plugCallback[] = $handler;

        return function () use ($handler) {
            $this->plugCallback = array_filter($this->plugCallback, function ($callback) use ($handler) {
                return $callback !== $handler;
            });
        };
    }

    /**
     * Add a listener on unplug event.
     *
     * @param callable $handler
     *
     * @return callable remove listener callback
     */
    public function onUnplug(callable $handler)
    {
        $this->unplugCallback[] = $handler;

        return function () use ($handler) {
            $this->unplugCallback = array_filter($this->unplugCallback, function ($callback) use ($handler) {
                return $callback !== $handler;
            });
        };
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
