<?php

declare(strict_types=1);

namespace Letkode\Helpers\Validation;

use Letkode\Helpers\Contract\ValidatorHelperInterface;

/**
 * Validates that a string is valid JSON.
 */
final readonly class IsValidJsonHelper implements ValidatorHelperInterface
{
    public function handle(mixed $value, array $parameters = []): bool
    {
        if (!\is_string($value) || '' === $value) {
            return false;
        }

        json_decode($value);

        return \JSON_ERROR_NONE === json_last_error();
    }
}
