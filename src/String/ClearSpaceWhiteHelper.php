<?php

declare(strict_types=1);

namespace Letkode\Helpers\String;

use Letkode\Helpers\Contract\StringHelperInterface;

/**
 * Clears white space and removes new lines from a string.
 */
final readonly class ClearSpaceWhiteHelper implements StringHelperInterface
{
    public function handle(string $string, array $parameters = []): string
    {
        $string = mb_trim($string);
        $string = (string) preg_replace("/[\n|\r|\n\r]/", '', $string);

        return (string) preg_replace("/\s+/", ' ', $string);
    }
}
