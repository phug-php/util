<?php

namespace Phug\Test\Util;

use Phug\Util\AbstractModule;
use Phug\Util\ModuleInterface;
use Phug\Util\ModulesContainerInterface;
use Phug\Util\Partial\ModuleTrait;
use stdClass;

//@codingStandardsIgnoreStart
/**
 * Class TestModuleClass.
 */
class TestParentClass implements ModulesContainerInterface
{
    use ModuleTrait;
}

class TestParentBisClass implements ModulesContainerInterface
{
    use ModuleTrait;
}

class TestNoInterfacedParentClass
{
    use ModuleTrait;
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
     * @covers \Phug\Util\Partial\ModuleTrait
     * @covers \Phug\Util\Partial\ModuleTrait::getModuleName
     * @covers \Phug\Util\Partial\ModuleTrait::getExpectedModuleType
     * @covers \Phug\Util\Partial\ModuleTrait::setExpectedModuleType
     * @covers \Phug\Util\Partial\ModuleTrait::addModule
     * @covers \Phug\Util\Partial\ModuleTrait::addModules
     * @covers \Phug\Util\Partial\ModuleTrait::hasModule
     * @covers \Phug\Util\Partial\ModuleTrait::getModule
     * @covers \Phug\Util\Partial\ModuleTrait::removeModule
     */
    public function testModule()
    {
        $parent = new TestParentClass();
        self::assertFalse($parent->hasModule(TestModuleClass::class));
        self::assertSame(null, $parent->getModule(TestModuleClass::class));
        self::assertSame($parent, $parent->addModule(TestModuleClass::class));
        self::assertTrue($parent->hasModule(TestModuleClass::class));
        $module1 = $parent->getModule(TestModuleClass::class);
        $module2 = new TestModuleClass();
        self::assertSame($parent, $parent->addModule($module2));
        self::assertTrue($parent->hasModule($module2));
        self::assertInstanceOf(TestModuleClass::class, $module1);
        self::assertTrue($module1->isPlugged());
        self::assertSame($parent, $parent->removeModule(TestModuleClass::class));
        self::assertTrue($parent->hasModule($module2));
        self::assertSame($parent, $module2->getParent());
        self::assertFalse($parent->hasModule(TestModuleClass::class));
        self::assertFalse($module1->isPlugged());
        self::assertSame(ModuleInterface::class, $parent->getExpectedModuleType());
        self::assertSame($parent, $parent->setExpectedModuleType(TestModuleBisClass::class));
        self::assertSame(TestModuleBisClass::class, $parent->getExpectedModuleType());
        self::assertSame($parent, $parent->addModules([TestModuleBisClass::class, TestModuleTerClass::class]));
        self::assertTrue($parent->hasModule(TestModuleBisClass::class));
        self::assertTrue($parent->hasModule(TestModuleTerClass::class));
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
