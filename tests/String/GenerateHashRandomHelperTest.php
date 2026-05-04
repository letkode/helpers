<?php

declare(strict_types=1);

namespace Letkode\Helpers\Tests\String;

use Letkode\Helpers\String\GenerateHashRandomHelper;
use PHPUnit\Framework\TestCase;

final class GenerateHashRandomHelperTest extends TestCase
{
    public function testDefaultLengthIsThirtyTwo(): void
    {
        $helper = new GenerateHashRandomHelper();
        self::assertSame(32, \strlen($helper->handle('')));
    }

    public function testCustomLength(): void
    {
        $helper = new GenerateHashRandomHelper(length: 64);
        self::assertSame(64, \strlen($helper->handle('')));
    }

    public function testOutputIsNotEmpty(): void
    {
        $helper = new GenerateHashRandomHelper();
        self::assertNotEmpty($helper->handle(''));
    }

    public function testTwoCallsProduceDifferentResults(): void
    {
        $helper = new GenerateHashRandomHelper(length: 32);
        $first = $helper->handle('');
        $second = $helper->handle('');
        // Statistically virtually impossible to collide with length 32
        self::assertNotSame($first, $second);
    }

    public function testContainsOnlyAllowedCharacters(): void
    {
        $helper = new GenerateHashRandomHelper(length: 200);
        $result = $helper->handle('');
        self::assertMatchesRegularExpression('/^[a-zA-Z0-9!@#$%&*_]+$/', $result);
    }
}
