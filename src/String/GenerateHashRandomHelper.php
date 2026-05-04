<?php

declare(strict_types=1);

namespace Letkode\Helpers\String;

use Letkode\Helpers\Contract\StringHelperInterface;

/**
 * Generates a random hash string.
 */
final readonly class GenerateHashRandomHelper implements StringHelperInterface
{
    public function __construct(
        private int $length = 32,
    ) {
    }

    /**
     * @param string               $string     unused for generation but kept for interface
     * @param array<string, mixed> $parameters unused
     */
    public function handle(string $string, array $parameters = []): string
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_';
        $max = \strlen($chars) - 1;
        $result = '';

        for ($i = 0; $i < $this->length; ++$i) {
            $result .= $chars[random_int(0, $max)];
        }

        return $result;
    }
}
