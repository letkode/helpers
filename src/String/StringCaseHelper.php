<?php

declare(strict_types=1);

namespace Letkode\Helpers\String;

use Letkode\Helpers\Contract\StringHelperInterface;

/**
 * Changes string casing (snake, camel, kebab, etc.).
 */
final readonly class StringCaseHelper implements StringHelperInterface
{
    public function __construct(
        private string $case = 'snake',
        private string $separate = ' ',
        private bool $hasClear = true,
        private CleanSpecialCharactersHelper $cleaner = new CleanSpecialCharactersHelper(space: false, sign: true),
    ) {
    }

    /**
     * @param string               $string     The string to transform
     * @param array<string, mixed> $parameters unused
     */
    public function handle(string $string, array $parameters = []): string
    {
        if ($this->hasClear) {
            $string = $this->cleaner->handle($string);
        }

        return match ($this->case) {
            'snake' => strtolower(str_replace($this->separate, '_', $string)),
            'lCamel' => $this->toCamelCase($string, $this->separate, false),
            'uCamel' => $this->toCamelCase($string, $this->separate, true),
            'kebab' => strtolower(str_replace($this->separate, '-', $string)),
            'ucwords' => ucwords(strtolower($string)),
            default => $string,
        };
    }

    private function toCamelCase(string $string, string $separate, bool $upper): string
    {
        if ('' === $separate) {
            return $upper ? ucfirst($string) : $string;
        }

        $parts = explode($separate, $string);
        $result = '';
        foreach ($parts as $i => $part) {
            if (0 === $i && !$upper) {
                $result .= strtolower($part);
            } else {
                $result .= ucwords(strtolower($part));
            }
        }

        return $result;
    }
}
