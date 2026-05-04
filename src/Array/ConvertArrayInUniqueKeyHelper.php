<?php

declare(strict_types=1);

namespace Letkode\Helpers\Array;

use Letkode\Helpers\Contract\ArrayHelperInterface;

/**
 * Flatten a nested array into a single-level array with concatenated keys.
 */
final readonly class ConvertArrayInUniqueKeyHelper implements ArrayHelperInterface
{
    public function __construct(
        private string $prefix = '',
        private string $separator = '.',
    ) {
    }

    /**
     * @param array<array-key, mixed> $array      The nested array
     * @param array{iterator?: int}   $parameters
     *
     * @return array<string, mixed>
     */
    public function handle(array $array, array $parameters = []): array
    {
        $iterator = $parameters['iterator'] ?? 0;
        $prefix = $this->prefix;

        if (0 === $iterator && '' !== $prefix) {
            $prefix = \sprintf('%s%s', $prefix, $this->separator);
        }

        $result = [];
        foreach ($array as $key => $value) {
            $currentIterator = $iterator + 1;

            if (\is_array($value)) {
                $nestedResult = $this->handle($value, [
                    'iterator' => $currentIterator,
                ]);
                $result = array_merge($result, $nestedResult);
            } else {
                $result[\sprintf('%s%s', $prefix, $key)] = $value;
            }
        }

        return $result;
    }
}
