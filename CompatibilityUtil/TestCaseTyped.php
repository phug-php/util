<?php

namespace Phug\CompatibilityUtil;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;

// @codeCoverageIgnoreStart
if (!isset($testCaseInitialization) || !class_exists(TestCaseTypeBase::class, false)) {
    return;
}

class TestCaseTypeBase extends PHPUnitTestCase
{
    protected function prepareTest()
    {
        // Override
    }

    protected function finishTest()
    {
        // Override
    }

    protected function setUp(): void
    {
        $this->prepareTest();
    }

    protected function tearDown(): void
    {
        $this->finishTest();
    }

    public static function assertMatchesRegularExpression(string $pattern, string $string, string $message = ''): void
    {
        if (!method_exists(parent::class, 'assertMatchesRegularExpression')) {
            self::assertRegExp($pattern, $string, $message);

            return;
        }

        parent::assertMatchesRegularExpression($pattern, $string, $message);
    }
}
// @codeCoverageIgnoreEnd
