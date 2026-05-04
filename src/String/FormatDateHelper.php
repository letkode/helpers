<?php

declare(strict_types=1);

namespace Letkode\Helpers\String;

use DateTime;
use Letkode\Helpers\Contract\StringHelperInterface;

/**
 * Transforms a date string from multiple possible input formats to a target format.
 */
final readonly class FormatDateHelper implements StringHelperInterface
{
    public function __construct(
        private string $targetFormat = 'Y-m-d',
    ) {
    }

    /**
     * @param string               $string     The date string to format
     * @param array<string, mixed> $parameters unused
     */
    public function handle(string $string, array $parameters = []): string
    {
        $formatsCheck = [
            'd/m/Y', 'j/n/Y', 'm/d/Y', 'n/j/Y', 'Y-m-d',
            'Y-n-j', 'd-m-Y', 'j-n-Y', 'm-d-Y', 'n-j-Y',
        ];

        foreach ($formatsCheck as $formatCheck) {
            $d = DateTime::createFromFormat($formatCheck, $string);
            if ($d && $d->format($formatCheck) === $string) {
                return $d->format($this->targetFormat);
            }
        }

        return $string;
    }
}
