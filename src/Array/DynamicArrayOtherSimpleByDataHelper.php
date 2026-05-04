<?php

declare(strict_types=1);

namespace Letkode\Helpers\Array;

use Letkode\Helpers\Contract\ArrayHelperInterface;

/**
 * Converts a flat array with dot-separated keys into a nested array.
 */
final readonly class DynamicArrayOtherSimpleByDataHelper implements ArrayHelperInterface
{
    public function __construct(
        private string $separator = '.',
    ) {
    }

    /**
     * @param array<string, mixed> $array      The flat array
     * @param array<string, mixed> $parameters unused
     *
     * @return array<mixed>
     */
    public function handle(array $array, array $parameters = []): array
    {
        if ('' === $this->separator) {
            return $array;
        }

        $values = [];

        foreach ($array as $keyVal => $value) {
            $keyArray = explode($this->separator, (string) $keyVal);

            $tmpArray = array_reduce(array_reverse($keyArray), static function ($carry, $item) use ($value) {
                if (empty($carry)) {
                    return [$item => $value];
                }

                return [$item => $carry];
            }, []);

            $values = array_merge_recursive($values, $tmpArray);
        }

        return $values;
    }
}
