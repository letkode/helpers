<?php

declare(strict_types=1);

namespace Letkode\Helpers\String;

use Letkode\Helpers\Contract\StringHelperInterface;

/**
 * Ensures a string is valid UTF-8 and trims it.
 */
final readonly class StringToUTF8Helper implements StringHelperInterface
{
    public function handle(string $string, array $parameters = []): string
    {
        if (!mb_check_encoding($string, 'UTF-8')) {
            $string = mb_convert_encoding($string, 'UTF-8');
        }

        return mb_trim($string);
    }
}
