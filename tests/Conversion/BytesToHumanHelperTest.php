<?php

declare(strict_types=1);

namespace Letkode\Helpers\Tests\Conversion;

use Letkode\Helpers\Conversion\BytesToHumanHelper;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class BytesToHumanHelperTest extends TestCase
{
    #[DataProvider('bytesProvider')]
    public function testHandle(int|float $input, string $expected): void
    {
        $helper = new BytesToHumanHelper();
        self::assertSame($expected, $helper->handle($input));
    }

    /**
     * @return array<string, array{int|float, string}>
     */
    public static function bytesProvider(): array
    {
        return [
            'bytes' => [512, '512.00 B'],
            'kilobytes' => [1024, '1.00 KB'],
            'megabytes' => [1048576, '1.00 MB'],
            'gigabytes' => [1073741824, '1.00 GB'],
            'zero' => [0, '0.00 B'],
        ];
    }

    public function testCustomDecimals(): void
    {
        $helper = new BytesToHumanHelper(decimals: 0);
        self::assertSame('1 KB', $helper->handle(1024));
    }

    public function testCustomDecimalPoint(): void
    {
        $helper = new BytesToHumanHelper(decimals: 2, decimalPoint: ',');
        self::assertSame('1,00 KB', $helper->handle(1024));
    }

    public function testCustomThousandsSeparator(): void
    {
        $helper = new BytesToHumanHelper(decimals: 2, thousandsSep: '.');
        self::assertSame('1.00 KB', $helper->handle(1024));
    }
}
