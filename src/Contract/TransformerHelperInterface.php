<?php

declare(strict_types=1);

namespace Letkode\Helpers\Contract;

/**
 * Contract for all transformation helpers where input and output types match.
 */
interface TransformerHelperInterface
{
    /**
     * Transforms $value using the provided $parameters.
     *
     * @param mixed                $value      The value to transform
     * @param array<string, mixed> $parameters Implementation-specific options
     */
    public function handle(mixed $value, array $parameters = []): mixed;
}
