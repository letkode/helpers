<?php

declare(strict_types=1);

namespace Letkode\Helpers\Contract;

/**
 * Contract for all $array transformation helpers.
 *
 * Implementations receive a raw array and an optional parameter bag,
 * and return the transformed result. The shape of $parameters is
 * defined by each concrete implementation.
 */
interface ArrayHelperInterface
{
    /**
     * Transforms $array using the provided $parameters.
     *
     * @param array<mixed>         $array
     * @param array<string, mixed> $parameters implementation-specific options
     *
     * @return array<mixed>
     */
    public function handle(array $array, array $parameters = []): array;
}
