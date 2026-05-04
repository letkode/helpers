<?php

declare(strict_types=1);

namespace Letkode\Helpers\Tests\Validation;

use Letkode\Helpers\Validation\IsValidEmailHelper;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class IsValidEmailHelperTest extends TestCase
{
    private IsValidEmailHelper $helper;

    protected function setUp(): void
    {
        $this->helper = new IsValidEmailHelper();
    }

    #[DataProvider('validEmailProvider')]
    public function testValidEmails(string $email): void
    {
        self::assertTrue($this->helper->handle($email));
    }

    /**
     * @return array<string, array{string}>
     */
    public static function validEmailProvider(): array
    {
        return [
            'simple' => ['user@example.com'],
            'subdomain' => ['user@mail.example.com'],
            'plus tag' => ['user+tag@example.com'],
            'dot in local' => ['first.last@example.com'],
        ];
    }

    #[DataProvider('invalidEmailProvider')]
    public function testInvalidEmails(mixed $email): void
    {
        self::assertFalse($this->helper->handle($email));
    }

    /**
     * @return array<string, array{mixed}>
     */
    public static function invalidEmailProvider(): array
    {
        return [
            'no at sign' => ['userexample.com'],
            'no domain' => ['user@'],
            'empty string' => [''],
            'null value' => [null],
            'integer' => [42],
            'spaces' => ['user @example.com'],
        ];
    }
}
