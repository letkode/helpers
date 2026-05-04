<?php

declare(strict_types=1);

namespace Letkode\Helpers\Tests\Exception;

use Letkode\Helpers\Exception\HelperException;
use Letkode\Helpers\Exception\InvalidConfigurationException;
use Letkode\Helpers\Exception\InvalidInputException;
use Letkode\Helpers\Exception\MissingParameterException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class HelperExceptionTest extends TestCase
{
    public function testHelperExceptionExtendsRuntimeException(): void
    {
        $e = MissingParameterException::forKey('foo');
        self::assertInstanceOf(RuntimeException::class, $e);
        self::assertInstanceOf(HelperException::class, $e);
    }

    public function testMissingParameterExceptionCarriesKey(): void
    {
        $e = MissingParameterException::forKey('my_param');
        self::assertSame('letkode_helpers.exception.missing_parameter', $e->translationKey);
        self::assertSame(['{{ key }}' => 'my_param'], $e->translationParams);
        self::assertStringContainsString('my_param', $e->getMessage());
    }

    public function testInvalidInputExceptionCarriesType(): void
    {
        $e = InvalidInputException::forValue(42);
        self::assertSame('letkode_helpers.exception.invalid_input', $e->translationKey);
        self::assertSame([], $e->translationParams);
        self::assertStringContainsString('int', $e->getMessage());
    }

    public function testInvalidConfigurationExceptionCarriesDetail(): void
    {
        $e = InvalidConfigurationException::forDetail('size must be positive');
        self::assertSame('letkode_helpers.exception.invalid_configuration', $e->translationKey);
        self::assertSame(['{{ detail }}' => 'size must be positive'], $e->translationParams);
        self::assertStringContainsString('size must be positive', $e->getMessage());
    }

    public function testExceptionsAreThrowable(): void
    {
        $this->expectException(MissingParameterException::class);
        throw MissingParameterException::forKey('test');
    }
}
