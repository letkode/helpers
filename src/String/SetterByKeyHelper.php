<?php

declare(strict_types=1);

namespace Letkode\Helpers\String;

use Letkode\Helpers\Contract\StringHelperInterface;

/**
 * Generates a setter method name from a key.
 */
final readonly class SetterByKeyHelper implements StringHelperInterface
{
    public function __construct(
        private StringCaseHelper $caseHelper = new StringCaseHelper(case: 'lCamel', separate: '_'),
    ) {
    }

    /**
     * @param string               $string     The key/tag
     * @param array<string, mixed> $parameters unused
     */
    public function handle(string $string, array $parameters = []): string
    {
        return $this->caseHelper->handle(\sprintf('set_%s', $string));
    }
}
