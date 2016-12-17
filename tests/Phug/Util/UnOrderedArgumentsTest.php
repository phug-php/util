<?php

namespace Phug\Test\Util;

use Phug\Util\UnOrderedArguments;

/**
 * Class UnOrderedArgumentsTest
 * @package Phug\Test\Util
 * @coversDefaultClass \Phug\Util\UnOrderedArguments
 */
class UnOrderedArgumentsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct
     * @covers ::optional
     */
    public function testOptional()
    {
        $arguments = new UnOrderedArguments(['foo', 42]);

        self::assertSame(42, $arguments->optional('integer'));
        self::assertSame(null, $arguments->optional('array'));
        self::assertSame('foo', $arguments->optional('string'));
    }

    /**
     * @covers ::required
     */
    public function testRequired()
    {
        $argument = new UnOrderedArguments('test');
        $arguments = new UnOrderedArguments(['foo', 42, $argument]);

        self::assertSame('foo', $arguments->required('string'));
        self::assertSame($argument, $arguments->required(UnOrderedArguments::class));
        self::assertSame(42, $arguments->required('integer'));
    }

    /**
     * @covers                   ::required
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage Arguments miss one of the boolean type
     */
    public function testRequiredException()
    {
        $argument = new UnOrderedArguments('test');
        $arguments = new UnOrderedArguments(['foo', 42, $argument, []]);

        $arguments->required('boolean');
    }

    /**
     * @covers ::noMoreArguments
     */
    public function testNoMoreArguments()
    {
        $arguments = new UnOrderedArguments(['foo']);

        $arguments->optional('string');
        self::assertSame(null, $arguments->noMoreArguments());
    }

    /**
     * @covers                   ::required
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage You pass 2 unexpected arguments
     */
    public function testNoMoreArgumentsException()
    {
        $arguments = new UnOrderedArguments(['foo', 'bar', 'biz', 42]);

        $arguments->optional('string');
        $arguments->required('string');
        $arguments->noMoreArguments();
    }
}