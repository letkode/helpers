<?php

declare(strict_types=1);

namespace Letkode\Helpers\String;

use Letkode\Helpers\Contract\StringHelperInterface;

/**
 * Generates an excerpt (summary) from a long string.
 */
final readonly class ExcerptHelper implements StringHelperInterface
{
    public function __construct(
        private int $length = 100,
        private string $suffix = '...',
    ) {
    }

    /**
     * @param string               $string     The text to summarize
     * @param array<string, mixed> $parameters unused
     */
    public function handle(string $string, array $parameters = []): string
    {
        $string = strip_tags($string);
        $string = mb_trim($string);

        if (mb_strlen($string) <= $this->length) {
            return $string;
        }

        $excerpt = mb_substr($string, 0, $this->length);
        $lastSpace = mb_strrpos($excerpt, ' ');

        if (false !== $lastSpace) {
            $excerpt = mb_substr($excerpt, 0, $lastSpace);
        }

        return $excerpt . $this->suffix;
    }
}
