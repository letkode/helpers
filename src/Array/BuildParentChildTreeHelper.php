<?php

declare(strict_types=1);

namespace Letkode\Helpers\Array;

use Letkode\Helpers\Contract\ArrayHelperInterface;

/**
 * Builds a parent-child relationship tree from a flat array.
 */
final readonly class BuildParentChildTreeHelper implements ArrayHelperInterface
{
    /**
     * @param array<array{parent_id: int|string, parent_name: string, child_id: int|string, child_name: string}> $array
     * @param array<string, mixed>                                                                               $parameters unused
     *
     * @return array<int|string, mixed>
     */
    public function handle(array $array, array $parameters = []): array
    {
        $result = [];
        foreach ($array as $item) {
            if (!isset($result[$item['parent_id']])) {
                $result[$item['parent_id']] = [
                    'id' => $item['parent_id'],
                    'name' => $item['parent_name'],
                    'children' => [],
                ];
            }

            $result[$item['parent_id']]['children'][$item['child_id']] = [
                'id' => $item['child_id'],
                'name' => $item['child_name'],
            ];
        }

        return $result;
    }
}
