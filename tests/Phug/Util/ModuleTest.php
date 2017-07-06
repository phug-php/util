<?php

namespace Phug\Test\Util;

use Phug\Util\AbstractModule;
use Phug\Util\ModuleContainerInterface;
use Phug\Util\ModuleInterface;
use Phug\Util\Partial\ModuleContainerTrait;
use stdClass;

//@codingStandardsIgnoreStart
/**
 * Class TestModuleClass.
 */
class TestParentClass implements ModuleContainerInterface
{
    use ModuleContainerTrait;
}

class TestParentBisClass implements ModuleContainerInterface
{
    use ModuleContainerTrait;
}

class TestNoInterfacedParentClass
{
    use ModuleContainerTrait;
}

class TestModuleClass extends AbstractModule
{
}

class TestModuleBisClass extends AbstractModule
{
}

class TestModuleTerClass extends TestModuleBisClass
{
}

/**
 * Class ModuleTest.
 */
class ModuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Phug\Util\AbstractModule
     * @covers \Phug\Util\AbstractModule::<public>
     * @covers \Phug\Util\Partial\ModuleContainerTrait
     * @covers \Phug\Util\Partial\ModuleContainerTrait::getModuleBaseClassName
     * @covers \Phug\Util\Partial\ModuleContainerTrait::addModule
     * @covers \Phug\Util\Partial\ModuleContainerTrait::addModules
     * @covers \Phug\Util\Partial\ModuleContainerTrait::hasModule
     * @covers \Phug\Util\Partial\ModuleContainerTrait::getModule
     * @covers \Phug\Util\Partial\ModuleContainerTrait::removeModule
     */
    public function testModule()
    {
        $container = new TestParentClass();
        self::assertFalse($container->hasModule(TestModuleClass::class));
        self::assertSame(null, $container->getModule(TestModuleClass::class));
        self::assertSame($container, $container->addModule(TestModuleClass::class));
        self::assertTrue($container->hasModule(TestModuleClass::class));
        $module1 = $container->getModule(TestModuleClass::class);
        self::assertInstanceOf(TestModuleClass::class, $module1);
        self::assertSame($container, $container->removeModule(TestModuleClass::class));
        self::assertFalse($container->hasModule(TestModuleClass::class));
        self::assertSame(ModuleInterface::class, $container->getModuleBaseClassName());
        self::assertSame($container, $container->addModules([TestModuleBisClass::class, TestModuleTerClass::class]));
        self::assertTrue($container->hasModule(TestModuleBisClass::class));
        self::assertTrue($container->hasModule(TestModuleTerClass::class));
    }

    /**
     * @covers \Phug\Util\AbstractModule
     * @covers \Phug\Util\AbstractModule::<public>
     * @covers \Phug\Util\Partial\ModuleTrait::getModuleName
     * @covers \Phug\Util\Partial\ModuleTrait::addModule
     * @covers \Phug\Util\Partial\ModuleTrait::removeModule
     */
    public function testModuleEvents()
    {
        $count = 0;
        $module = new TestModuleClass();
        $offPlug = $module->onPlug(function (ModulesContainerInterface $container) use (&$count) {
            $count++;
        });
        $offUnplug = $module->onUnplug(function (ModulesContainerInterface $container) use (&$count) {
            $count += 2;
        });
        $parent1 = new TestParentClass();
        $parent1->addModule($module);
        self::assertSame(1, $count);
        $parent1->removeModule($module);
        self::assertSame(3, $count);
        $offPlug();
        $offUnplug();
        $parent2 = new TestParentBisClass();
        $parent2->addModule($module);
        self::assertSame(3, $count);
        $parent2->removeModule($module);
        self::assertSame(3, $count);
    }

    /**
     * @covers                   \Phug\Util\AbstractModule
     * @covers                   \Phug\Util\AbstractModule::<public>
     * @covers                   \Phug\Util\Partial\ModuleTrait::getModuleName
     * @covers                   \Phug\Util\Partial\ModuleTrait::addModule
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage Phug\Util\Partial\ModuleTrait must be used with Phug\Util\ModulesContainerInterface
     */
    public function testWrongContainerException()
    {
        $parent = new TestNoInterfacedParentClass();
        $parent->addModule(TestModuleClass::class);
    }

    /**
     * @covers                   \Phug\Util\AbstractModule
     * @covers                   \Phug\Util\AbstractModule::<public>
     * @covers                   \Phug\Util\Partial\ModuleTrait::getModuleName
     * @covers                   \Phug\Util\Partial\ModuleTrait::addModule
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage Passed module needs to implement Phug\Util\ModuleInterface. stdClass given.
     */
    public function testWrongModuleException()
    {
        $someObj = new stdClass();
        $parent = new TestParentClass();
        $parent->addModule($someObj);
    }
}
//@codingStandardsIgnoreEnd
