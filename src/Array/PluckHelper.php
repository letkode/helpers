<?php

declare(strict_types=1);

namespace Letkode\Helpers\Array;

use Letkode\Helpers\Contract\ArrayHelperInterface;

/**
 * Extracts a list of values from a specific key in an array of arrays.
 */
final readonly class PluckHelper implements ArrayHelperInterface
{
    public function __construct(
        private string $key,
    ) {
    }

    /**
     * @param array<array-key, array<string, mixed>> $array
     * @param array<string, mixed>                   $parameters unused
     *
     * @return list<mixed>
     */
    public function handle(array $array, array $parameters = []): array
    {
        return array_column($array, $this->key);
    }
}
