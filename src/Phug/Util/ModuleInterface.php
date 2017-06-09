<?php

namespace Phug\Util;

/**
 * Interface ModuleInterface.
 */
interface ModuleInterface
{
    public function plug(ModulesContainerInterface $parent);

    public function unplug();

    public function isPlugged();

    public function getParent();
}
