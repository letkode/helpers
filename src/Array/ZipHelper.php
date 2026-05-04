<?php

declare(strict_types=1);

namespace Letkode\Helpers\Array;

use Letkode\Helpers\Contract\ArrayHelperInterface;

/**
 * Combines two arrays into an associative array using the first as keys and second as values.
 * Truncates to the length of the shorter array.
 * Pass the values array via $parameters['with'].
 */
final readonly class ZipHelper implements ArrayHelperInterface
{
    /**
     * @param array<mixed>         $array
     * @param array<string, mixed> $parameters
     *
     * @return array<mixed>
     */
    public function handle(array $array, array $parameters = []): array
    {
        $rawWith = $parameters['with'] ?? [];
        $with = \is_array($rawWith) ? $rawWith : [];

        $keys = array_values($array);
        $values = array_values($with);
        $count = min(\count($keys), \count($values));

        $result = [];
        for ($i = 0; $i < $count; ++$i) {
            $k = $keys[$i];
            if (!\is_int($k) && !\is_string($k)) {
                continue;
            }
            $result[$k] = $values[$i];
        }

        return $result;
    }
}
