<?php

namespace Phug\Test\Util;

use Phug\Util\ModuleInterface;
use stdClass;

//@codingStandardsIgnoreStart

/**
 * @coversDefaultClass Phug\Util\Partial\ModuleContainerTrait
 */
class ModuleContainerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::getModuleBaseClassName
     * @covers ::addModule
     * @covers ::addModules
     * @covers ::hasModule
     * @covers ::getModule
     * @covers ::removeModule
     */
    public function testHasGetSetRemoveModule()
    {
        require_once __DIR__.'/MockModuleContainer.php';

        $container = new MockModuleContainer();

        self::assertSame(ModuleInterface::class, $container->getModuleBaseClassName());

        self::assertFalse($container->hasModule(FirstTestModule::class));
        self::assertFalse($container->hasModule(SecondTestModule::class));

        self::assertSame($container, $container->addModule(FirstTestModule::class));

        self::assertTrue($container->hasModule(FirstTestModule::class));
        self::assertInstanceOf(FirstTestModule::class, $container->getModule(FirstTestModule::class));
        self::assertFalse($container->hasModule(SecondTestModule::class));

        self::assertSame($container, $container->removeModule(FirstTestModule::class));

        self::assertFalse($container->hasModule(FirstTestModule::class));
        self::assertFalse($container->hasModule(SecondTestModule::class));

        self::assertSame($container, $container->addModules([
            FirstTestModule::class,
            SecondTestModule::class,
        ]));

        self::assertTrue($container->hasModule(FirstTestModule::class));
        self::assertInstanceOf(FirstTestModule::class, $container->getModule(FirstTestModule::class));

        self::assertTrue($container->hasModule(SecondTestModule::class));
        self::assertInstanceOf(SecondTestModule::class, $container->getModule(SecondTestModule::class));
    }

    /**
     * @covers ::getModuleBaseClassName
     * @covers ::addModule
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Passed module class name needs to be a class extending Phug\Util\ModuleInterface and/or Phug\Util\ModuleInterface
     */
    public function testInvalidModuleClassName()
    {
        require_once __DIR__.'/MockModuleContainer.php';

        $container = new MockModuleContainer();
        self::assertSame(ModuleInterface::class, $container->getModuleBaseClassName());
        $container->addModule(stdClass::class);
    }

    /**
     * @covers ::getModuleBaseClassName
     * @covers ::addModule
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Module Phug\Test\Util\FirstTestModule is already registered.
     */
    public function testDoubleRegistration()
    {
        require_once __DIR__.'/MockModuleContainer.php';

        $container = new MockModuleContainer();
        self::assertSame(ModuleInterface::class, $container->getModuleBaseClassName());
        $container->addModule(FirstTestModule::class);
        $container->addModule(FirstTestModule::class);
    }

    /**
     * @covers ::getModuleBaseClassName
     * @covers ::removeModule
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The container doesn't contain a Phug\Test\Util\FirstTestModule module
     */
    public function testRemovalOfNonExistentModule()
    {
        require_once __DIR__.'/MockModuleContainer.php';

        $container = new MockModuleContainer();
        self::assertSame(ModuleInterface::class, $container->getModuleBaseClassName());
        self::assertFalse($container->hasModule(FirstTestModule::class));
        $container->removeModule(FirstTestModule::class);
    }

    /**
     * @covers ::addModule
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Current module container uses the ModuleContainerTrait, but doesn't implement Phug\Util\ModuleContainerInterface, please implement it.
     */
    public function testNonInterfacedContainer()
    {
        require_once __DIR__.'/MockModuleContainer.php';

        $container = new MockModuleContainerWithoutInterface();
        $container->addModule(FirstTestModule::class);
    }
}
//@codingStandardsIgnoreEnd
