<?php

declare(strict_types=1);

namespace Letkode\Helpers\Conversion;

use Letkode\Helpers\Contract\ConverterHelperInterface;

/**
 * Converts a number to its ordinal word representation in Spanish.
 */
final readonly class NumberToOrdinalHelper implements ConverterHelperInterface
{
    public function handle(mixed $value, array $parameters = []): string
    {
        $number = is_numeric($value) ? (int) $value : 0;
        $units = str_split((string) $number);

        $words = [
            0 => ['', 'primero', 'segundo', 'tercero', 'cuarto', 'quinto', 'sexto', 'séptimo', 'octavo', 'noveno'],
            1 => ['', 'décimo', 'vigésimo', 'trigésimo', 'cuadragésimo', 'quincuagésimo', 'sexagésimo', 'septuagésimo', 'octogésimo', 'nonagésimo'],
            2 => ['', 'centésimo', 'ducentésimo', 'tricentésimo', 'cuadringentésimo', 'quingentésimo', 'sexcentésimo', 'septingentésimo', 'octingentésimo', 'noningentésimo'],
        ];

        $arr = [];
        foreach ($units as $index => $unit) {
            $w = $words[$index][(int) $unit] ?? '';
            if ('' !== $w) {
                $arr[] = $w;
            }
        }

        return implode(' ', $arr);
    }
}
