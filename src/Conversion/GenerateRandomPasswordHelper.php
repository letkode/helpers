<?php

declare(strict_types=1);

namespace Letkode\Helpers\Conversion;

use Letkode\Helpers\Contract\ConverterHelperInterface;

/**
 * Generates a random password.
 */
final readonly class GenerateRandomPasswordHelper implements ConverterHelperInterface
{
    public function __construct(
        private int $length = 12,
        private bool $includeSymbol = false,
    ) {
    }

    /**
     * @param mixed                $value      unused
     * @param array<string, mixed> $parameters unused
     */
    public function handle(mixed $value, array $parameters = []): string
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $symbols = '!@#$%^&*()_+-={}[]|:;"<>,.?/~`';

        if ($this->includeSymbol) {
            $chars .= $symbols;
        }

        $password = '';
        $max = \strlen($chars) - 1;

        for ($i = 0; $i < $this->length; ++$i) {
            $password .= $chars[random_int(0, $max)];
        }

        return $password;
    }
}
