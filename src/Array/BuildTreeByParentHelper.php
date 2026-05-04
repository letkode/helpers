<?php

declare(strict_types=1);

namespace Letkode\Helpers\Array;

use Letkode\Helpers\Contract\ArrayHelperInterface;

/**
 * Builds a multi-level tree structure from a flat array with level indicators.
 */
final readonly class BuildTreeByParentHelper implements ArrayHelperInterface
{
    /**
     * @param array<array{parent_id: string|int, _id: string|int, _level: string}> $array
     * @param array<string, mixed>                                                 $parameters unused
     *
     * @return list<mixed>
     */
    public function handle(array $array, array $parameters = []): array
    {
        $levels = array_unique(array_column($array, '_level'));
        $maxLevel = \count($levels);

        $prevLevelData = [];
        $finalTree = [];

        for ($i = $maxLevel; $i >= 1; --$i) {
            $currentLevelKey = "level_{$i}";
            $currentLevelData = [];
            $levelItems = array_filter($array, static fn ($item) => $item['_level'] === $currentLevelKey);

            foreach ($levelItems as $item) {
                if ($i < $maxLevel && isset($prevLevelData[$item['_id']])) {
                    $item['children'] = array_values($prevLevelData[$item['_id']]);
                }

                $currentLevelData[$item['parent_id']][$item['_id']] = $item;
            }

            if (1 === $i) {
                $finalTree = $currentLevelData;
            }

            $prevLevelData = $currentLevelData;
        }

        $root = current($finalTree);

        return $root ? array_values($root) : [];
    }
}
