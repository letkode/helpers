<?php

declare(strict_types=1);

namespace Letkode\Helpers\Tests\Conversion;

use Letkode\Helpers\Conversion\CurrencyFormatHelper;
use PHPUnit\Framework\TestCase;

final class CurrencyFormatHelperTest extends TestCase
{
    public function testDefaultFormatting(): void
    {
        $helper = new CurrencyFormatHelper();
        self::assertSame('$1,234.50', $helper->handle(1234.5));
    }

    public function testSymbolAfterValue(): void
    {
        $helper = new CurrencyFormatHelper(symbol: '€', symbolBefore: false);
        self::assertSame('100.00€', $helper->handle(100));
    }

    public function testCustomDecimals(): void
    {
        $helper = new CurrencyFormatHelper(decimals: 0);
        self::assertSame('$1,235', $helper->handle(1234.5));
    }

    public function testCustomSeparators(): void
    {
        $helper = new CurrencyFormatHelper(
            symbol: 'R$',
            decimalPoint: ',',
            thousandsSep: '.',
            symbolBefore: true,
        );
        self::assertSame('R$1.234,50', $helper->handle(1234.5));
    }

    public function testZeroValue(): void
    {
        $helper = new CurrencyFormatHelper();
        self::assertSame('$0.00', $helper->handle(0));
    }

    public function testNegativeValue(): void
    {
        $helper = new CurrencyFormatHelper();
        self::assertSame('$-50.00', $helper->handle(-50));
    }
}
