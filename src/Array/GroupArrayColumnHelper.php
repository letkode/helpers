<?php

declare(strict_types=1);

namespace Letkode\Helpers\Array;

use Letkode\Helpers\Contract\ArrayHelperInterface;

/**
 * Groups an array by an index key and extracts a specific column.
 */
final readonly class GroupArrayColumnHelper implements ArrayHelperInterface
{
    public function __construct(
        private string|int $columnKey,
        private string|int $indexKey,
    ) {
    }

    /**
     * @param array<array-key, array<string, mixed>> $array
     * @param array<string, mixed>                   $parameters unused
     *
     * @return array<int|string, list<mixed>>
     */
    public function handle(array $array, array $parameters = []): array
    {
        $output = [];
        foreach ($array as $item) {
            $indexValue = $item[$this->indexKey] ?? null;
            if (!\is_int($indexValue) && !\is_string($indexValue)) {
                continue;
            }
            $output[$indexValue][] = $item[$this->columnKey] ?? null;
        }

        return $output;
    }
}
