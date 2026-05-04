<?php

declare(strict_types=1);

namespace Letkode\Helpers\Array;

use Letkode\Helpers\Contract\ArrayHelperInterface;

/**
 * Builds a hierarchical list of groups (Ascending or Descending).
 */
final readonly class BuildTreeUserGroupHelper implements ArrayHelperInterface
{
    public function __construct(
        private string $direction = 'DESC',
        private bool $addGroupBase = true,
    ) {
    }

    /**
     * @param array<int|string, int|string>     $array      The tree mapping (child => parent)
     * @param array{groupBase?: int|array<int>} $parameters
     *
     * @return list<int|string>
     */
    public function handle(array $array, array $parameters = []): array
    {
        $groupBase = $parameters['groupBase'] ?? [];

        $groups = match ($this->direction) {
            'DESC' => $this->buildTreeDesc($array, $groupBase),
            'ASC' => $this->buildTreeAsc($array, $groupBase),
            'DD' => $this->buildTreeDesc($array, $groupBase, true),
            'UD' => $this->buildTreeAsc($array, $groupBase, true),
            'BI' => array_merge(
                $this->buildTreeAsc($array, $groupBase),
                $this->buildTreeDesc($array, $groupBase)
            ),
            'BID' => array_merge(
                $this->buildTreeAsc($array, $groupBase, true),
                $this->buildTreeDesc($array, $groupBase, true)
            ),
            default => [],
        };

        if ($this->addGroupBase) {
            if (\is_array($groupBase)) {
                $groups = array_merge($groups, $groupBase);
            } else {
                $groups[] = $groupBase;
            }
        }

        return array_values(array_unique($groups));
    }

    /**
     * @param array<int|string, int|string> $tree
     * @param int|array<int>                $parent
     *
     * @return list<int|string>
     */
    private function buildTreeDesc(array $tree, mixed $parent, bool $direct = false): array
    {
        if ($direct) {
            return array_keys(array_filter($tree, static fn ($p) => $p === $parent));
        }

        $result = [];
        $current = \is_array($parent) ? $parent : [$parent];

        while (true) {
            $children = array_keys(array_intersect($tree, $current));
            if (empty($children)) {
                break;
            }
            $result = array_merge($result, $children);
            $current = $children;
        }

        return $result;
    }

    /**
     * @param array<int|string, int|string> $tree
     * @param int|array<int>                $child
     *
     * @return list<int|string>
     */
    private function buildTreeAsc(array $tree, mixed $child, bool $direct = false): array
    {
        if ($direct) {
            if (\is_array($child)) {
                $parents = [];
                foreach ($child as $c) {
                    if (isset($tree[$c])) {
                        $parents[] = $tree[$c];
                    }
                }

                return $parents;
            }

            return isset($tree[$child]) ? [$tree[$child]] : [];
        }

        $result = [];
        /** @var list<int|string> $current */
        $current = \is_array($child) ? array_values($child) : [$child];

        while (true) {
            $parents = array_values(array_intersect_key($tree, array_flip($current)));
            if (empty($parents)) {
                break;
            }
            $result = array_merge($result, $parents);
            $current = $parents;
        }

        return $result;
    }
}
