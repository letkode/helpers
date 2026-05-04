<?php

declare(strict_types=1);

namespace Letkode\Helpers\Exception;

final class InvalidInputException extends HelperException
{
    public static function forValue(mixed $value): self
    {
        return new self(
            translationKey: 'letkode_helpers.exception.invalid_input',
            translationParams: [],
            defaultMessage: \sprintf('The provided value "%s" is not valid.', get_debug_type($value)),
        );
    }
}
