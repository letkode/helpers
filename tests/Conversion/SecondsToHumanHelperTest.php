<?php

declare(strict_types=1);

namespace Letkode\Helpers\Tests\Conversion;

use Letkode\Helpers\Conversion\SecondsToHumanHelper;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class SecondsToHumanHelperTest extends TestCase
{
    #[DataProvider('longProvider')]
    public function testLongFormat(int|float $input, string $expected): void
    {
        $helper = new SecondsToHumanHelper(short: false);
        self::assertSame($expected, $helper->handle($input));
    }

    /**
     * @return array<string, array{int|float, string}>
     */
    public static function longProvider(): array
    {
        return [
            'zero' => [0, '0 seconds'],
            'one second' => [1, '1 second'],
            'one minute' => [60, '1 minute'],
            'one hour' => [3600, '1 hour'],
            'complex' => [3661, '1 hour, 1 minute, 1 second'],
            'multiple hours' => [7322, '2 hours, 2 minutes, 2 seconds'],
            'negative' => [-90, '1 minute, 30 seconds'],
        ];
    }

    #[DataProvider('shortProvider')]
    public function testShortFormat(int $input, string $expected): void
    {
        $helper = new SecondsToHumanHelper(short: true);
        self::assertSame($expected, $helper->handle($input));
    }

    /**
     * @return array<string, array{int, string}>
     */
    public static function shortProvider(): array
    {
        return [
            'zero' => [0, '0s'],
            'seconds' => [90, '1m 30s'],
            'hours' => [3661, '1h 1m 1s'],
        ];
    }
}
