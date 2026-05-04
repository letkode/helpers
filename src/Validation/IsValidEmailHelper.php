<?php

declare(strict_types=1);

namespace Letkode\Helpers\Validation;

use Letkode\Helpers\Contract\ValidatorHelperInterface;

/**
 * Validates an email address format, with optional DNS MX check.
 */
final readonly class IsValidEmailHelper implements ValidatorHelperInterface
{
    public function __construct(
        private bool $checkMx = false,
    ) {
    }

    public function handle(mixed $value, array $parameters = []): bool
    {
        if (!\is_string($value) || '' === $value) {
            return false;
        }

        if (false === filter_var($value, \FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        if ($this->checkMx) {
            $domain = substr($value, strpos($value, '@') + 1);

            return checkdnsrr($domain, 'MX');
        }

        return true;
    }
}
