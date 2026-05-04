<?php

declare(strict_types=1);

namespace Letkode\Helpers\Tests\Validation;

use Letkode\Helpers\Validation\IsValidIpHelper;
use PHPUnit\Framework\TestCase;

final class IsValidIpHelperTest extends TestCase
{
    public function testValidIpV4(): void
    {
        $helper = new IsValidIpHelper();
        self::assertTrue($helper->handle('192.168.1.1'));
    }

    public function testValidIpV6(): void
    {
        $helper = new IsValidIpHelper();
        self::assertTrue($helper->handle('2001:0db8:85a3:0000:0000:8a2e:0370:7334'));
    }

    public function testInvalidIp(): void
    {
        $helper = new IsValidIpHelper();
        self::assertFalse($helper->handle('999.999.999.999'));
        self::assertFalse($helper->handle('not-an-ip'));
        self::assertFalse($helper->handle(''));
    }

    public function testNonStringInput(): void
    {
        $helper = new IsValidIpHelper();
        self::assertFalse($helper->handle(null));
        self::assertFalse($helper->handle(12345));
    }

    public function testDisallowIpV6(): void
    {
        $helper = new IsValidIpHelper(allowV6: false);
        self::assertFalse($helper->handle('::1'));
        self::assertTrue($helper->handle('127.0.0.1'));
    }

    public function testDisallowPrivateRange(): void
    {
        $helper = new IsValidIpHelper(allowPrivate: false);
        self::assertFalse($helper->handle('192.168.1.1'));
        self::assertFalse($helper->handle('10.0.0.1'));
    }
}
