<?php

declare(strict_types=1);

namespace Letkode\Helpers\Conversion;

use Carbon\Carbon;
use DateTimeInterface;
use Letkode\Helpers\Contract\ConverterHelperInterface;

/**
 * Converts a date to its long word representation (e.g., "1 de Mayo de 2026").
 */
final readonly class DateToWordsHelper implements ConverterHelperInterface
{
    public function __construct(
        private string $locale = 'es',
    ) {
    }

    /**
     * @param string|DateTimeInterface|null $value      The date to convert
     * @param array<string, mixed>          $parameters unused
     */
    public function handle(mixed $value, array $parameters = []): string
    {
        if (null === $value) {
            return '';
        }

        /** @var Carbon $date */
        $date = Carbon::parse($value)->locale($this->locale);

        return \sprintf('%d de %s de %d', $date->day, $date->monthName, $date->year);
    }
}
