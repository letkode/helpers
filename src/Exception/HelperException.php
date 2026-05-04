<?php

declare(strict_types=1);

namespace Letkode\Helpers\Exception;

use RuntimeException;

abstract class HelperException extends RuntimeException
{
    /**
     * @param array<string, mixed> $translationParams
     */
    public function __construct(
        public readonly string $translationKey,
        public readonly array $translationParams = [],
        string $defaultMessage = '',
    ) {
        parent::__construct($defaultMessage);
    }
}
