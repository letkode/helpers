<?php

declare(strict_types=1);

namespace Letkode\Helpers\Conversion;

use DateTime;
use DateTimeInterface;
use Letkode\Helpers\Contract\ConverterHelperInterface;

/**
 * Generates an array of DateTime objects for a specific range from a start date.
 */
final readonly class DateRangeHelper implements ConverterHelperInterface
{
    public function __construct(
        private int $quantityInterval = 1,
        private string $typeInterval = 'day',
        private string $format = 'Y-m-d H:i:s',
    ) {
    }

    /**
     * @param string|DateTimeInterface $value      The start date
     * @param array<string, mixed>     $parameters unused
     *
     * @return array<DateTimeInterface>
     */
    public function handle(mixed $value, array $parameters = []): array
    {
        $date = $value instanceof DateTimeInterface
            ? new DateTime($value->format($this->format))
            : new DateTime((string) $value);

        $range = [new DateTime($date->format($this->format))];

        for ($i = 1; $i < $this->quantityInterval; ++$i) {
            $date->modify(\sprintf('+%d %s', 1, $this->typeInterval));
            $range[] = new DateTime($date->format($this->format));
        }

        return $range;
    }
}
