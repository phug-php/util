<?php

namespace Phug\Util\Partial;

use Phug\EventManagerTrait;
use Phug\Util\ModuleContainerInterface;
use Phug\Util\ModuleInterface;

/**
 * Class ModuleContainerTrait.
 */
trait ModuleContainerTrait
{
    use EventManagerTrait, OptionTrait;

    /**
     * @var ModuleInterface[]
     */
    private $modules = [];

    public function hasModule($className)
    {
        return isset($this->modules[$className]);
    }

    public function getModule($className)
    {
        return $this->modules[$className];
    }

    public function addModule($className)
    {
        if (!is_subclass_of($className, $this->getModuleBaseClassName(), true)
            || !is_subclass_of($className, ModuleInterface::class)) {
            throw new \InvalidArgumentException(
                'Passed module class name needs to be a class extending '.$this->getModuleBaseClassName()
                .' and/or '.ModuleInterface::class
            );
        }

        if (isset($this->modules[$className])) {
            throw new \InvalidArgumentException(
                'Module '.$className.' is already registered.'
            );
        }

        if (!($this instanceof ModuleContainerInterface)) {
            throw new \RuntimeException(
                'Current module container uses the ModuleContainerTrait, but doesn\'t implement '
                .ModuleContainerInterface::class.', please implement it.'
            );
        }

        /** @var ModuleInterface $module */
        $module = new $className($this);
        $module->attachEvents();
        $this->modules[$className] = $module;

        return $this;
    }

    public function addModules(array $classNames)
    {
        foreach ($classNames as $className) {
            $this->addModule($className);
        }

        return $this;
    }

    public function removeModule($className)
    {
        if (!$this->hasModule($className)) {
            throw new \InvalidArgumentException(
                'The container doesn\'t contain a '.$className.' module'
            );
        }

        $this->modules[$className]->detachEvents();
        unset($this->modules[$className]);

        return $this;
    }

    public function getModuleBaseClassName()
    {
        return ModuleInterface::class;
    }
}
