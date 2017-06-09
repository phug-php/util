<?php

namespace Phug\Util\Partial;

use Phug\Util\ModuleInterface;
use Phug\Util\ModulesContainerInterface;

/**
 * Class ModuleTrait.
 */
trait ModuleTrait
{
    /**
     * @var array[ModuleInterface]
     */
    private $modules;

    /**
     * @var string
     */
    private $expectedModuleType;

    protected function getModuleName($module)
    {
        $expectedModuleType = $this->getExpectedModuleType();
        if ($module !== $expectedModuleType && !is_subclass_of($module, $expectedModuleType)) {
            throw new \InvalidArgumentException(
                'Passed module needs to implement '.
                $expectedModuleType.'. '.
                (is_object($module) ? get_class($module) : $module).
                ' given.'
            );
        }

        return is_string($module)
            ? $module
            : spl_object_hash($module);
    }

    /**
     * @return ModuleInterface|string
     */
    public function getExpectedModuleType()
    {
        return $this->expectedModuleType ?: ModuleInterface::class;
    }

    /**
     * @param ModuleInterface|string

     * @return $this
     */
    public function setExpectedModuleType($expectedModuleType)
    {
        $this->expectedModuleType = $expectedModuleType;

        return $this;
    }

    /**
     * Plug a module to the instance.
     *
     * @param ModuleInterface|string $module
     *
     * @return $this
     */
    public function addModule($module)
    {
        $moduleName = $this->getModuleName($module);

        if (is_string($module)) {
            $module = new $module();
        }

        if (!($this instanceof ModulesContainerInterface)) {
            throw new \InvalidArgumentException(
                'Phug\Util\Partial\ModuleTrait must be used with Phug\Util\ModulesContainerInterface '.
                'interface. '.
                (is_object($this) ? get_class($this) : $this).
                ' given.'
            );
        }

        $module->plug($this);
        $this->modules[$moduleName] = $module;

        return $this;
    }

    /**
     * Plug modules to the instance.
     *
     * @param array[ModuleInterface|string] $modules
     *
     * @return $this
     */
    public function addModules($modules)
    {
        foreach ($modules as $module) {
            $this->addModule($module);
        }

        return $this;
    }

    /**
     * Return true if module is present.
     *
     * @param ModuleInterface|string
     *
     * @return bool
     */
    public function hasModule($module)
    {
        $moduleName = $this->getModuleName($module);

        return isset($this->modules[$moduleName]);
    }

    /**
     * Return module or null if not plugged.
     *
     * @param ModuleInterface|string
     *
     * @return ModuleInterface
     */
    public function getModule($module)
    {
        $moduleName = $this->getModuleName($module);

        return $this->modules[$moduleName];
    }

    /**
     * Unplug a module to the instance.
     *
     * @param $module
     *
     * @return $this
     */
    public function removeModule($module)
    {
        $moduleName = $this->getModuleName($module);

        if (isset($this->modules[$moduleName])) {
            $this->modules[$moduleName]->unplug();
            unset($this->modules[$moduleName]);
        }

        return $this;
    }
}
