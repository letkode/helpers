<?php

declare(strict_types=1);

namespace Letkode\Helpers\Validation;

use Letkode\Helpers\Contract\ValidatorHelperInterface;

/**
 * Validates password strength based on several criteria.
 */
final readonly class IsValidStrengthHelper implements ValidatorHelperInterface
{
    public function __construct(
        private int $minLength = 8,
    ) {
    }

    /**
     * @param string               $value      The password to validate
     * @param array<string, mixed> $parameters unused
     */
    public function handle(mixed $value, array $parameters = []): bool
    {
        if (!\is_string($value)) {
            return false;
        }

        $criteria = [
            'length' => \strlen($value) >= $this->minLength,
            'upper' => (bool) preg_match('/[A-Z]/', $value),
            'lower' => (bool) preg_match('/[a-z]/', $value),
            'number' => (bool) preg_match('/\d/', $value),
            'special' => (bool) preg_match('/[!@#$%^&*()_+\-=\[\]{};\':"\\|,.<>\/?]/', $value),
        ];

        return array_all($criteria, static fn (bool $valid): bool => $valid);
    }
}
