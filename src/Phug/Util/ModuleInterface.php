<?php

namespace Phug\Util;

/**
 * Interface ModuleInterface.
 */
interface ModuleInterface
{
    public function plug(ModulesContainerInterface $parent);

    public function unplug();

    public function onPlug(callable $handler);

    public function onUnplug(callable $handler);

    public function isPlugged();

    public function getParent();
}
