<?php

declare(strict_types=1);

namespace Letkode\Helpers\Tests\Validation;

use Letkode\Helpers\Validation\IsValidJsonHelper;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class IsValidJsonHelperTest extends TestCase
{
    private IsValidJsonHelper $helper;

    protected function setUp(): void
    {
        $this->helper = new IsValidJsonHelper();
    }

    #[DataProvider('validJsonProvider')]
    public function testValidJson(string $input): void
    {
        self::assertTrue($this->helper->handle($input));
    }

    /**
     * @return array<string, array{string}>
     */
    public static function validJsonProvider(): array
    {
        return [
            'object' => ['{"key":"value"}'],
            'array' => ['[1,2,3]'],
            'null' => ['null'],
            'boolean true' => ['true'],
            'number' => ['42'],
            'nested' => ['{"a":{"b":1}}'],
        ];
    }

    #[DataProvider('invalidJsonProvider')]
    public function testInvalidJson(mixed $input): void
    {
        self::assertFalse($this->helper->handle($input));
    }

    /**
     * @return array<string, array{mixed}>
     */
    public static function invalidJsonProvider(): array
    {
        return [
            'unquoted key' => ['{key: "value"}'],
            'trailing comma' => ['[1,2,]'],
            'empty string' => [''],
            'plain text' => ['hello world'],
            'null value' => [null],
            'integer' => [42],
        ];
    }
}
