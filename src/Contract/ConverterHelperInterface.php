<?php

declare(strict_types=1);

namespace Letkode\Helpers\Contract;

/**
 * Contract for all conversion helpers.
 * Transforms a value from one type or format to another.
 */
interface ConverterHelperInterface
{
    /**
     * Converts $value using the provided $parameters.
     *
     * @param mixed                $value      The value to convert
     * @param array<string, mixed> $parameters Implementation-specific options
     */
    public function handle(mixed $value, array $parameters = []): mixed;
}
