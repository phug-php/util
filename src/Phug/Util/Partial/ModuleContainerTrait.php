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
     * @var array<ModuleInterface>
     */
    private $modules = [];

    public function hasModule($module)
    {
        return $module instanceof ModuleInterface
            ? in_array($module, $this->modules)
            : isset($this->modules[$module]);
    }

    public function getModule($module)
    {
        return $module instanceof ModuleInterface
            ? $module
            : $this->modules[$module];
    }

    public function addModule($module)
    {
        if ($module instanceof ModuleInterface) {
            if (in_array($module, $this->modules)) {
                throw new \InvalidArgumentException(
                    'This occurrence of '.get_class($module).' is already registered.'
                );
            }
            if ($module->getContainer() !== $this) {
                throw new \InvalidArgumentException(
                    'This occurrence of '.get_class($module).' is already registered in another module container.'
                );
            }

            $module->attachEvents();
            $this->modules[] = $module;

            return $this;
        }

        /** @var string $className */
        $className = $module;

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

    public function addModules(array $modules)
    {
        foreach ($modules as $module) {
            $this->addModule($module);
        }

        return $this;
    }

    public function removeModule($module)
    {
        if ($module instanceof ModuleInterface) {
            if (!in_array($module, $this->modules)) {
                throw new \InvalidArgumentException(
                    'This occurrence of '.get_class($module).' is not registered.'
                );
            }

            $this->modules = array_filter($this->modules, function ($instance) use ($module) {
                return $instance !== $module;
            });

            return $this;
        }

        /** @var string $className */
        $className = $module;

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
