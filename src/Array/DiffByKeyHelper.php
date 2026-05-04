<?php

declare(strict_types=1);

namespace Letkode\Helpers\Array;

use Letkode\Helpers\Contract\ArrayHelperInterface;

/**
 * Returns items from $array whose key value is not present in $parameters['against'].
 * Works with arrays of arrays and arrays of objects.
 */
final readonly class DiffByKeyHelper implements ArrayHelperInterface
{
    public function __construct(
        private string $key,
    ) {
    }

    /**
     * @param array<mixed>         $array
     * @param array<string, mixed> $parameters
     *
     * @return list<mixed>
     */
    public function handle(array $array, array $parameters = []): array
    {
        $rawAgainst = $parameters['against'] ?? [];
        $against = \is_array($rawAgainst) ? $rawAgainst : [];
        $key = $this->key;

        $extract = static fn (mixed $item): mixed => \is_array($item)
            ? ($item[$key] ?? null)
            : (\is_object($item) ? ($item->{$key} ?? null) : null);

        $againstValues = array_map($extract, $against);

        return array_values(array_filter(
            $array,
            static fn (mixed $item): bool => !\in_array($extract($item), $againstValues, true)
        ));
    }
}
