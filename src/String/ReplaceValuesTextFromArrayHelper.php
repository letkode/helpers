<?php

declare(strict_types=1);

namespace Letkode\Helpers\String;

use InvalidArgumentException;
use Letkode\Helpers\Contract\StringHelperInterface;

/**
 * Replaces named placeholders in a string with values from an array.
 *
 * Placeholders use the format: #[key]#
 * Nested arrays in values are ignored — only scalar values are replaced.
 *
 * Usage:
 *   $helper->handle('Hello #[name]#!', ['values' => ['name' => 'World']]);
 *   // → "Hello World!"
 */
final readonly class ReplaceValuesTextFromArrayHelper implements StringHelperInterface
{
    public function __construct(
        private string $delimiterStart = '#[',
        private string $delimiterEnd = ']#',
    ) {
    }

    /**
     * @param array{values?: array<string, mixed>} $parameters
     *
     * @throws InvalidArgumentException when the "values" key is absent
     */
    public function handle(string $string, array $parameters = []): string
    {
        $values = $parameters['values'] ?? throw new InvalidArgumentException('Missing required "values" key in $parameters.');

        if ([] === $values) {
            return $string;
        }

        // Discard nested arrays — only scalar values can replace placeholders
        $values = array_filter($values, static fn (mixed $v): bool => !\is_array($v));

        if ([] === $values) {
            return $string;
        }

        $search = array_map(
            fn (string $k): string => $this->delimiterStart . $k . $this->delimiterEnd,
            array_keys($values),
        );

        $replace = array_map(
            static fn (mixed $v): string => \is_scalar($v) || null === $v ? (string) $v : '',
            array_values($values)
        );

        return str_replace($search, $replace, $string);
    }
}
