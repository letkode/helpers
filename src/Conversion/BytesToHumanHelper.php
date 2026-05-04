<?php

declare(strict_types=1);

namespace Letkode\Helpers\Conversion;

use Letkode\Helpers\Contract\ConverterHelperInterface;

/**
 * Converts a byte count into a human-readable size string (e.g. 1048576 → "1.00 MB").
 */
final readonly class BytesToHumanHelper implements ConverterHelperInterface
{
    public function __construct(
        private int $decimals = 2,
        private string $decimalPoint = '.',
        private string $thousandsSep = ',',
    ) {
    }

    public function handle(mixed $value, array $parameters = []): string
    {
        $bytes = is_numeric($value) ? (float) $value : 0.0;
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
        $i = 0;

        while ($bytes >= 1024.0 && $i < (\count($units) - 1)) {
            $bytes /= 1024.0;
            ++$i;
        }

        return number_format($bytes, $this->decimals, $this->decimalPoint, $this->thousandsSep) . ' ' . $units[$i];
    }
}
