<?php

declare(strict_types=1);

namespace Letkode\Helpers\Contract;

/**
 * Contract for all string transformation helpers.
 *
 * Implementations receive a raw string and an optional parameter bag,
 * and return the transformed result. The shape of $parameters is
 * defined by each concrete implementation.
 */
interface StringHelperInterface
{
    /**
     * Transforms $string using the provided $parameters.
     *
     * @param array<string, mixed> $parameters implementation-specific options
     */
    public function handle(string $string, array $parameters = []): string;
}
