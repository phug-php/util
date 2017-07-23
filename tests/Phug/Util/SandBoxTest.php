<?php

namespace Phug\Test\Util;

//@codingStandardsIgnoreStart
use Exception;
use Phug\Util\SandBox;

/**
 * @coversDefaultClass Phug\Util\SandBox
 */
class SandBoxTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getResult
     */
    public function testSuccess()
    {
        $sandBox = new SandBox(function () {
            return 'foo';
        });

        self::assertSame(null, $sandBox->getThrowable());
        self::assertSame('foo', $sandBox->getResult());
    }

    /**
     * @covers ::__construct
     * @covers ::getThrowable
     */
    public function testError()
    {
        $sandBox = new SandBox(function () {
            return 5 / 0;
        });

        self::assertInstanceOf(Exception::class, $sandBox->getThrowable());
        self::assertContains('Division by zero', $sandBox->getThrowable()->getMessage());
        self::assertSame(null, $sandBox->getResult());
    }
}
//@codingStandardsIgnoreEnd
