<?php

declare(strict_types=1);

namespace Letkode\Helpers\Array;

use Letkode\Helpers\Contract\ConverterHelperInterface;

/**
 * Searches for a value in a nested array using a path of keys.
 */
final readonly class SearchByArrayHelper implements ConverterHelperInterface
{
    /**
     * @param array<string> $searchArray
     */
    public function __construct(
        private array $searchArray = [],
        private mixed $default = null,
    ) {
    }

    /**
     * @param array<string, mixed>                                $value      The array to search in
     * @param array{searchArray?: array<string>, default?: mixed} $parameters
     */
    public function handle(mixed $value, array $parameters = []): mixed
    {
        if (!\is_array($value)) {
            return $parameters['default'] ?? $this->default;
        }

        $searchArray = $parameters['searchArray'] ?? $this->searchArray;
        $default = $parameters['default'] ?? $this->default;

        $currentValue = $value;
        foreach ($searchArray as $search) {
            if (\is_array($currentValue) && isset($currentValue[$search])) {
                $currentValue = $currentValue[$search];
            } else {
                return $default;
            }
        }

        return $currentValue;
    }
}
