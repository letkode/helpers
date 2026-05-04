<?php

declare(strict_types=1);

namespace Letkode\Helpers\String;

use Letkode\Helpers\Contract\StringHelperInterface;

/**
 * Converts a company name to title case while respecting:
 *  - Spanish connectors and prepositions (always lowercase)
 *  - Common legal entity suffixes (SA, SRL, Ltda, SpA, etc.)
 *  - Trailing dots on abbreviations (removed)
 */
final readonly class TitleCaseCompanyHelper implements StringHelperInterface
{
    private const ENCODING = 'UTF-8';

    /** Words that stay lowercase unless they are the first word. */
    private const LOWERCASE_EXCEPTIONS = [
        'en', 'e', 'de', 'del', 'la', 'el', 'y', 'o', 'a', 'con', 'por', 'para',
    ];

    /** Legal entity suffix normalisation: regex → canonical form. */
    private const LEGAL_SUFFIXES = [
        '/\bS\.?A\.?\b/i' => 'SA',
        '/\bS\.?R\.?L\.?\b/i' => 'SRL',
        '/\bS\.?C\.?C\.?\b/i' => 'SCC',
        '/\bE\.?I\.?R\.?L\.?\b/i' => 'EIRL',
        '/\bLtda\.?\b/i' => 'Ltda',
        '/\bSpA\b/i' => 'SpA',
    ];

    /**
     * @param array<string, mixed> $parameters unused — kept for interface compatibility
     */
    public function handle(string $string, array $parameters = []): string
    {
        // Normalise to title case using the correct encoding
        $string = mb_convert_case(
            mb_strtolower($string, self::ENCODING),
            \MB_CASE_TITLE,
            self::ENCODING,
        );

        // Lowercase connector / preposition words
        $words = explode(' ', $string);
        foreach ($words as $index => &$word) {
            if ($index > 0 && \in_array(mb_strtolower($word, self::ENCODING), self::LOWERCASE_EXCEPTIONS, true)) {
                $word = mb_strtolower($word, self::ENCODING);
            }
        }
        unset($word); // break the reference to avoid subtle bugs

        $string = implode(' ', $words);

        // Normalise legal entity suffixes (SA, SRL, Ltda, …)
        $string = preg_replace(array_keys(self::LEGAL_SUFFIXES), array_values(self::LEGAL_SUFFIXES), $string) ?? $string;

        // Strip trailing dots from abbreviations: "Corp." → "Corp"
        return preg_replace('/\b(\w+)\.(?=\s|$)/u', '$1', $string) ?? $string;
    }
}
