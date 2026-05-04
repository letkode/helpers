<?php

declare(strict_types=1);

namespace Letkode\Helpers\Contract;

/**
 * Contract for all validation helpers.
 * Returns true if the validation passes, false otherwise.
 */
interface ValidatorHelperInterface
{
    /**
     * Validates $value using the provided $parameters.
     *
     * @param mixed                $value      The value to validate
     * @param array<string, mixed> $parameters Implementation-specific options
     */
    public function handle(mixed $value, array $parameters = []): bool;
}
