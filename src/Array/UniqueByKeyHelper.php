<?php

declare(strict_types=1);

namespace Letkode\Helpers\Array;

use Letkode\Helpers\Contract\ArrayHelperInterface;

/**
 * Removes duplicate items from an array based on a specific key value.
 * Keeps the first occurrence. Works with arrays of arrays and arrays of objects.
 */
final readonly class UniqueByKeyHelper implements ArrayHelperInterface
{
    public function __construct(
        private string $key,
    ) {
    }

    /**
     * @param array<mixed>         $array
     * @param array<string, mixed> $parameters unused
     *
     * @return list<mixed>
     */
    public function handle(array $array, array $parameters = []): array
    {
        $seen = [];
        $result = [];

        foreach ($array as $item) {
            $keyValue = \is_array($item)
                ? ($item[$this->key] ?? null)
                : (\is_object($item) ? ($item->{$this->key} ?? null) : null);

            $hash = serialize($keyValue);

            if (!isset($seen[$hash])) {
                $seen[$hash] = true;
                $result[] = $item;
            }
        }

        return $result;
    }
}
