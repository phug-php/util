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
     * @covers ::getBuffer
     * @covers ::outputBuffer
     */
    public function testSuccess()
    {
        $sandBox = new SandBox(function () {
            echo 'bar';

            return 'foo';
        });

        self::assertSame(null, $sandBox->getThrowable());
        self::assertSame('foo', $sandBox->getResult());
        self::assertSame('bar', $sandBox->getBuffer());

        ob_start();
        $sandBox->outputBuffer();
        $contents = ob_get_contents();
        ob_end_clean();

        self::assertSame('bar', $contents);

        ob_start();
        $sandBox->outputBuffer();
        $contents = ob_get_contents();
        ob_end_clean();

        self::assertSame('', $contents);
    }

    /**
     * @covers ::__construct
     * @covers ::getThrowable
     * @covers ::getBuffer
     */
    public function testError()
    {
        $sandBox = new SandBox(function () {
            echo 'foo';
            $a = 5 / 0;
            echo 'bar';

            return $a;
        });

        self::assertInstanceOf(Exception::class, $sandBox->getThrowable());
        self::assertContains('Division by zero', $sandBox->getThrowable()->getMessage());
        self::assertSame(null, $sandBox->getResult());
        self::assertSame('foo', $sandBox->getBuffer());

        $sandBox = new SandBox(function () {
            return @implode('', '');
        });

        self::assertSame(null, $sandBox->getThrowable());

        $sandBox = new SandBox(function () {
            return implode('', '');
        });

        self::assertInstanceOf(Exception::class, $sandBox->getThrowable());
        self::assertContains('implode', $sandBox->getThrowable()->getMessage());
    }
}
//@codingStandardsIgnoreEnd
