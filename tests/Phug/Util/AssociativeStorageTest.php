<?php

namespace Phug\Test\Util;

use Phug\Util\AssociativeStorage;
use Phug\Util\Partial\NameTrait;

//@codingStandardsIgnoreStart
class Entity
{
    use NameTrait;
}
/**
 * Class AssociativeStorageTest.
 *
 * @coversDefaultClass Phug\Util\AssociativeStorage
 */
class AssociativeStorageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers                   ::<public>
     * @covers                   ::attachStrictMode
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage Duplicate entity for the name foo
     */
    public function testStrictMode()
    {
        $storage = new AssociativeStorage();
        $a = new Entity();
        $a->setName('foo');
        $b = new Entity();
        $b->setName('foo');

        $storage->attach($a);
        $storage->attach($b);
    }
}
//@codingStandardsIgnoreEnd
