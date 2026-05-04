<?php

declare(strict_types=1);

namespace Letkode\Helpers\Array;

use Letkode\Helpers\Contract\ArrayHelperInterface;

/**
 * Adds a prefix to all keys in an array, including nested arrays.
 */
final readonly class AddPrefixKeysHelper implements ArrayHelperInterface
{
    public function __construct(
        private string $prefix,
        private string $separator = '_',
    ) {
    }

    /**
     * @param array<array-key, mixed> $array
     * @param array<string, mixed>    $parameters unused
     *
     * @return array<string, mixed>
     */
    public function handle(array $array, array $parameters = []): array
    {
        $result = [];
        foreach ($array as $key => $value) {
            if (\is_array($value)) {
                $nested = $this->handle($value);
                $result = array_merge($result, $nested);
            } else {
                $result[$key] = $value;
            }
        }

        return array_combine(
            array_map(fn ($k) => \sprintf('%s%s%s', $this->prefix, $this->separator, $k), array_keys($result)),
            array_values($result)
        );
    }
}
