<?php

declare(strict_types=1);

namespace Letkode\Helpers\Array;

use Letkode\Helpers\Contract\ArrayHelperInterface;

/**
 * Sorts an array of associative arrays by a specific key.
 */
final readonly class SortByKeyHelper implements ArrayHelperInterface
{
    public function __construct(
        private string $key,
        private bool $orderDesc = false,
    ) {
    }

    /**
     * @param array<array-key, array<string, mixed>> $array
     * @param array<string, mixed>                   $parameters unused
     *
     * @return array<array-key, array<string, mixed>>
     */
    public function handle(array $array, array $parameters = []): array
    {
        uasort($array, fn ($a, $b) => ($a[$this->key] ?? 0) <=> ($b[$this->key] ?? 0));

        if ($this->orderDesc) {
            $array = array_reverse($array, true);
        }

        return $array;
    }
}
