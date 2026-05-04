<?php

declare(strict_types=1);

namespace Letkode\Helpers\Exception;

final class MissingParameterException extends HelperException
{
    public static function forKey(string $key): self
    {
        return new self(
            translationKey: 'letkode_helpers.exception.missing_parameter',
            translationParams: ['{{ key }}' => $key],
            defaultMessage: \sprintf('Missing required parameter "%s".', $key),
        );
    }
}
