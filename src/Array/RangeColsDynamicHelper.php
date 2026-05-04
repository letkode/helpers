<?php

declare(strict_types=1);

namespace Letkode\Helpers\Array;

use Letkode\Helpers\Contract\ArrayHelperInterface;

/**
 * Generates dynamic column names (A, B, ..., Z, AA, ...).
 */
final readonly class RangeColsDynamicHelper implements ArrayHelperInterface
{
    public function __construct(
        private int $count,
    ) {
    }

    /**
     * @param array<string, mixed> $array      unused
     * @param array<string, mixed> $parameters unused
     *
     * @return list<string>
     */
    public function handle(array $array, array $parameters = []): array
    {
        $range = range('A', 'Z');
        $qtyRange = \count($range);
        $result = [];
        $loop = (int) ceil($this->count / $qtyRange);
        $prefix = '';
        $qty = 0;

        for ($index = 1; $index <= $loop; ++$index) {
            foreach ($range as $rng) {
                ++$qty;

                if ($qty > $this->count) {
                    break;
                }

                $result[] = $prefix . $rng;
            }

            if ($index <= $qtyRange) {
                $prefix = $range[$index - 1];
            }
        }

        return $result;
    }
}
