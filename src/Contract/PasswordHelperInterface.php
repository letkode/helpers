<?php

declare(strict_types=1);

namespace Letkode\Helpers\Contract;

/**
 * Contract for password-related helpers (hashing, verification, generation).
 *
 * Implementations receive a raw password string and an optional parameter bag,
 * and return the processed result. The shape of $parameters is
 * defined by each concrete implementation.
 */
interface PasswordHelperInterface
{
    /**
     * Processes $password using the provided $parameters.
     *
     * @param array<string, mixed> $parameters implementation-specific options
     */
    public function handle(string $password, array $parameters = []): string;
}
