<?php

declare(strict_types=1);

namespace Letkode\Helpers\String;

use Letkode\Helpers\Contract\StringHelperInterface;

/**
 * Truncates a string to a maximum number of words without splitting words.
 */
final readonly class TruncateByWordsHelper implements StringHelperInterface
{
    public function __construct(
        private int $maxWords = 20,
        private string $suffix = '...',
    ) {
    }

    public function handle(string $string, array $parameters = []): string
    {
        $words = preg_split('/\s+/', trim($string), -1, \PREG_SPLIT_NO_EMPTY);

        if (false === $words) {
            return $string;
        }

        if (\count($words) <= $this->maxWords) {
            return $string;
        }

        return implode(' ', \array_slice($words, 0, $this->maxWords)) . $this->suffix;
    }
}
