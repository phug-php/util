<?php

namespace Phug\Util;

use Phug\EventManagerInterface;

interface ModuleContainerInterface extends EventManagerInterface, OptionInterface
{
    public function hasModule($className);

    public function getModule($className);

    public function addModule($className);

    public function addModules(array $classNames);

    public function removeModule($className);

    public function getModuleBaseClassName();
}
