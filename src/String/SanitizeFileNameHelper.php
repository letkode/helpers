<?php

declare(strict_types=1);

namespace Letkode\Helpers\String;

use Letkode\Helpers\Contract\StringHelperInterface;

/**
 * Sanitizes a string for use as a safe file name across all operating systems.
 */
final readonly class SanitizeFileNameHelper implements StringHelperInterface
{
    public function __construct(
        private bool $allowDots = true,
    ) {
    }

    /**
     * @param string               $string     The file name to sanitize
     * @param array<string, mixed> $parameters unused
     */
    public function handle(string $string, array $parameters = []): string
    {
        // Transliterate to ASCII and lowercase
        $string = transliterator_transliterate('Any-Latin; Latin-ASCII; Lower()', $string);

        // Remove characters that are not alphanumeric, dots (if allowed), underscores or hyphens
        $pattern = $this->allowDots ? '/[^a-z0-9\._\-]/' : '/[^a-z0-9_\-]/';
        $string = (string) preg_replace($pattern, '-', (string) $string);

        // Clean up multiple separators and trim
        $string = (string) preg_replace('/-+/', '-', $string);

        return mb_trim($string, '-');
    }
}
