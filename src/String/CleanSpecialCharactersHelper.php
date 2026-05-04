<?php

declare(strict_types=1);

namespace Letkode\Helpers\String;

use Letkode\Helpers\Contract\StringHelperInterface;

/**
 * Cleans special characters, tags, and entities from a string.
 */
final readonly class CleanSpecialCharactersHelper implements StringHelperInterface
{
    public function __construct(
        private bool $space = true,
        private bool $sign = true,
        /** @var array<string> */
        private array $excludeSign = [],
        private StringToUTF8Helper $toUTF8 = new StringToUTF8Helper(),
        private NormalizeStringHelper $normalizer = new NormalizeStringHelper(),
    ) {
    }

    /**
     * @param string               $string     The string to clean
     * @param array<string, mixed> $parameters unused
     */
    public function handle(string $string, array $parameters = []): string
    {
        $string = $this->toUTF8->handle($this->normalizer->handle($string));

        $string = strip_tags($string);
        $string = html_entity_decode($string);

        if ($this->space) {
            $string = str_replace(' ', '_', $string);
        }

        if ($this->sign) {
            $signArray = array_diff(
                [
                    '\\', '¨', 'º', '-', '~', '#', '@', '|', '!', '"', '®', '°', '·', '$', '%', '&', '/', '(', ')',
                    '?', "'", '¡', '¿', '[', '^', ']', '+', '}', '{', '¨', '´', '>', '< ', ';', ',', ':', '.',
                    '\\n', '\\t',
                ],
                $this->excludeSign
            );

            $string = str_replace($signArray, '', $string);
        }

        return $string;
    }
}
