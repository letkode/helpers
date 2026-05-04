<?php

declare(strict_types=1);

namespace Letkode\Helpers\Exception;

final class InvalidConfigurationException extends HelperException
{
    public static function forDetail(string $detail): self
    {
        return new self(
            translationKey: 'letkode_helpers.exception.invalid_configuration',
            translationParams: ['{{ detail }}' => $detail],
            defaultMessage: \sprintf('Invalid helper configuration: %s.', $detail),
        );
    }
}
