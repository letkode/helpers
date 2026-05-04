<?php

declare(strict_types=1);

namespace Letkode\Helpers\Array;

use Letkode\Helpers\Contract\ArrayHelperInterface;
use Letkode\Helpers\String\StringCaseHelper;

/**
 * Converts array keys to camelCase (Doctrine style).
 */
final readonly class ConvertValuesToDoctrineHelper implements ArrayHelperInterface
{
    public function __construct(
        private StringCaseHelper $caseHelper = new StringCaseHelper(case: 'lCamel', separate: '_'),
    ) {
    }

    /**
     * @param array<string, mixed> $array
     * @param array<string, mixed> $parameters unused
     *
     * @return array<string, mixed>
     */
    public function handle(array $array, array $parameters = []): array
    {
        $returnValues = [];

        foreach ($array as $key => $value) {
            $newKey = $this->caseHelper->handle((string) $key);
            $returnValues[$newKey] = $value;
        }

        return $returnValues;
    }
}
