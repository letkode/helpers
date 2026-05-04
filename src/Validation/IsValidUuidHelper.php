<?php

declare(strict_types=1);

namespace Letkode\Helpers\Validation;

use Letkode\Helpers\Contract\ValidatorHelperInterface;
use Symfony\Component\Uid\Uuid;

/**
 * Validates if a string is a valid UUID.
 */
final readonly class IsValidUuidHelper implements ValidatorHelperInterface
{
    public function handle(mixed $value, array $parameters = []): bool
    {
        if (!\is_string($value)) {
            return false;
        }

        return Uuid::isValid($value);
    }
}
