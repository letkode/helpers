<?php

declare(strict_types=1);

namespace Letkode\Helpers\Conversion;

use Letkode\Helpers\Contract\ConverterHelperInterface;
use NumberFormatter;

/**
 * Converts a number to its word representation.
 */
final readonly class NumberToWordsHelper implements ConverterHelperInterface
{
    public function __construct(
        private string $locale = 'es_MX',
    ) {
    }

    /**
     * @param int|float            $value      The number to convert
     * @param array<string, mixed> $parameters unused
     */
    public function handle(mixed $value, array $parameters = []): string
    {
        if (!is_numeric($value)) {
            return '';
        }

        $formatter = new NumberFormatter($this->locale, NumberFormatter::SPELLOUT);
        $words = $formatter->format($value);

        if (false === $words) {
            return '';
        }

        if (1000000 == $value || str_ends_with($words, 'ones')) {
            $words .= ' de';
        }

        return $words;
    }
}
