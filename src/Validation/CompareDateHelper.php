<?php

declare(strict_types=1);

namespace Letkode\Helpers\Validation;

use DateTime;
use DateTimeInterface;
use Letkode\Helpers\Contract\ValidatorHelperInterface;

/**
 * Compares dates (greater, less, between) based on a type range defined in the constructor.
 */
final readonly class CompareDateHelper implements ValidatorHelperInterface
{
    public function __construct(
        private string $typeRange,
        private string $format = 'Y-m-d',
    ) {
    }

    /**
     * @param string|DateTimeInterface $value The date to compare
     * @param array{
     *     start?: string|DateTimeInterface,
     *     end?: string|DateTimeInterface
     * } $parameters
     */
    public function handle(mixed $value, array $parameters = []): bool
    {
        $date = $this->parseDate($value);
        if (!$date) {
            return false;
        }

        return match ($this->typeRange) {
            'greater-equal' => $this->compare($date, $parameters['start'] ?? null, '>='),
            'less-equal' => $this->compare($date, $parameters['end'] ?? null, '<='),
            'between' => $this->compare($date, $parameters['start'] ?? null, '>=')
                         && $this->compare($date, $parameters['end'] ?? null, '<='),
            default => false,
        };
    }

    private function parseDate(mixed $date): DateTimeInterface|null
    {
        if ($date instanceof DateTimeInterface) {
            return $date;
        }
        if (\is_string($date)) {
            return DateTime::createFromFormat($this->format, $date) ?: null;
        }

        return null;
    }

    private function compare(DateTimeInterface $date, mixed $target, string $operator): bool
    {
        $targetDate = $this->parseDate($target);
        if (!$targetDate) {
            return false;
        }

        return match ($operator) {
            '>=' => $date >= $targetDate,
            '<=' => $date <= $targetDate,
            default => false,
        };
    }
}
