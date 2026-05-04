<?php

declare(strict_types=1);

namespace Letkode\Helpers\Conversion;

use Letkode\Helpers\Contract\ConverterHelperInterface;

/**
 * Formats a numeric value as a currency string (e.g. 1234.5 → "$1,234.50").
 */
final readonly class CurrencyFormatHelper implements ConverterHelperInterface
{
    public function __construct(
        private string $symbol = '$',
        private int $decimals = 2,
        private string $decimalPoint = '.',
        private string $thousandsSep = ',',
        private bool $symbolBefore = true,
    ) {
    }

    public function handle(mixed $value, array $parameters = []): string
    {
        $formatted = number_format(is_numeric($value) ? (float) $value : 0.0, $this->decimals, $this->decimalPoint, $this->thousandsSep);

        return $this->symbolBefore
            ? $this->symbol . $formatted
            : $formatted . $this->symbol;
    }
}
