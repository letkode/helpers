<?php

declare(strict_types=1);

namespace Letkode\Helpers\Validation;

use Letkode\Helpers\Contract\ValidatorHelperInterface;

/**
 * Validates a URL format against an allowed scheme list.
 */
final readonly class IsValidUrlHelper implements ValidatorHelperInterface
{
    /**
     * @param string[] $allowedSchemes
     */
    public function __construct(
        private array $allowedSchemes = ['http', 'https'],
    ) {
    }

    public function handle(mixed $value, array $parameters = []): bool
    {
        if (!\is_string($value) || '' === $value) {
            return false;
        }

        if (false === filter_var($value, \FILTER_VALIDATE_URL)) {
            return false;
        }

        $scheme = parse_url($value, \PHP_URL_SCHEME);

        return \in_array($scheme, $this->allowedSchemes, true);
    }
}
