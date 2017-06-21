<?php

namespace Phug\Util;

/**
 * Interface ModulesContainerInterface.
 */
interface ModulesContainerInterface
{
    public function addModule($module);

    public function addModules($modules);

    public function hasModule($module);

    public function getModule($module);

    public function removeModule($module);
}
