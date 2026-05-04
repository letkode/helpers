<?php

declare(strict_types=1);

namespace Letkode\Helpers\Validation;

use Letkode\Helpers\Contract\ValidatorHelperInterface;

/**
 * Validates an IP address (v4 and/or v6), with optional range restrictions.
 */
final readonly class IsValidIpHelper implements ValidatorHelperInterface
{
    public function __construct(
        private bool $allowV6 = true,
        private bool $allowPrivate = true,
        private bool $allowReserved = true,
    ) {
    }

    public function handle(mixed $value, array $parameters = []): bool
    {
        if (!\is_string($value) || '' === $value) {
            return false;
        }

        $flags = $this->allowV6 ? 0 : \FILTER_FLAG_IPV4;

        if (!$this->allowPrivate) {
            $flags |= \FILTER_FLAG_NO_PRIV_RANGE;
        }

        if (!$this->allowReserved) {
            $flags |= \FILTER_FLAG_NO_RES_RANGE;
        }

        return false !== filter_var($value, \FILTER_VALIDATE_IP, $flags);
    }
}
