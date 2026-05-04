<?php

declare(strict_types=1);

namespace Letkode\Helpers\Contract;

/**
 * Contract for all $number transformation helpers.
 *
 * Implementations receive a raw number and an optional parameter bag,
 * and return the transformed result. The shape of $parameters is
 * defined by each concrete implementation.
 */
interface NumberHelperInterface
{
    /**
     * Transforms $number using the provided $parameters.
     *
     * @param array<string, mixed> $parameters implementation-specific options
     */
    public function handle(int|float $number, array $parameters = []): int|float;
}
