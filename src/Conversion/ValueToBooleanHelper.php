<?php

declare(strict_types=1);

namespace Letkode\Helpers\Conversion;

use Letkode\Helpers\Contract\ConverterHelperInterface;

/**
 * Converts common truthy/falsy strings to boolean.
 */
final readonly class ValueToBooleanHelper implements ConverterHelperInterface
{
    public function handle(mixed $value, array $parameters = []): bool
    {
        if (\is_bool($value)) {
            return $value;
        }

        if (!\is_scalar($value) && null !== $value) {
            return (bool) $value;
        }

        $upperValue = strtoupper((string) $value);

        return match ($upperValue) {
            'SI', 'TRUE', '1' => true,
            'NO', 'FALSE', '0' => false,
            default => (bool) $value,
        };
    }
}
