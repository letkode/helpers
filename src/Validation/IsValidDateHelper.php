<?php

declare(strict_types=1);

namespace Letkode\Helpers\Validation;

use DateTime;
use Letkode\Helpers\Contract\ValidatorHelperInterface;

/**
 * Validates if a string is a valid date according to a format.
 */
final readonly class IsValidDateHelper implements ValidatorHelperInterface
{
    public function __construct(
        private string $format = 'Y-m-d',
    ) {
    }

    /**
     * @param string               $value      The date string to validate
     * @param array<string, mixed> $parameters unused
     */
    public function handle(mixed $value, array $parameters = []): bool
    {
        if (!\is_string($value)) {
            return false;
        }

        $dateTime = DateTime::createFromFormat($this->format, $value);

        return $dateTime && $dateTime->format($this->format) === $value;
    }
}
