<?php

declare(strict_types=1);

namespace Letkode\Helpers\Array;

use Letkode\Helpers\Contract\ArrayHelperInterface;

/**
 * Flattens a multi-dimensional array into a single-level array (values only).
 */
final readonly class FlattenHelper implements ArrayHelperInterface
{
    /**
     * @param array<mixed>         $array
     * @param array<string, mixed> $parameters unused
     *
     * @return list<mixed>
     */
    public function handle(array $array, array $parameters = []): array
    {
        $result = [];
        array_walk_recursive($array, static function ($value) use (&$result): void {
            $result[] = $value;
        });

        return $result;
    }
}
