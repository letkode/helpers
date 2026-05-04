<?php

declare(strict_types=1);

namespace Letkode\Helpers\String;

use Letkode\Helpers\Contract\StringHelperInterface;

/**
 * Converts a string into a URL-friendly slug.
 */
final readonly class SlugifyHelper implements StringHelperInterface
{
    public function __construct(
        private string $separator = '-',
        private bool $nullable = false,
    ) {
    }

    /**
     * @param string               $string     The string to slugify
     * @param array<string, mixed> $parameters unused
     */
    public function handle(string $string, array $parameters = []): string
    {
        if (!mb_check_encoding($string, 'UTF-8')) {
            $string = mb_convert_encoding($string, 'UTF-8');
        }

        $string = transliterator_transliterate('Any-Latin; Latin-ASCII; Lower()', $string);
        $string = (string) preg_replace('~[^a-z\d]+~', $this->separator, (string) $string);
        $string = trim((string) $string, $this->separator);

        if (empty($string)) {
            return $this->nullable ? '' : 'n-a';
        }

        return $string;
    }
}
