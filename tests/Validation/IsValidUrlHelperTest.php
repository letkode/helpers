<?php

declare(strict_types=1);

namespace Letkode\Helpers\Tests\Validation;

use Letkode\Helpers\Validation\IsValidUrlHelper;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class IsValidUrlHelperTest extends TestCase
{
    private IsValidUrlHelper $helper;

    protected function setUp(): void
    {
        $this->helper = new IsValidUrlHelper();
    }

    #[DataProvider('validUrlProvider')]
    public function testValidUrls(string $url): void
    {
        self::assertTrue($this->helper->handle($url));
    }

    /**
     * @return array<string, array{string}>
     */
    public static function validUrlProvider(): array
    {
        return [
            'http' => ['http://example.com'],
            'https' => ['https://example.com'],
            'with path' => ['https://example.com/path/to/page'],
            'with query' => ['https://example.com?foo=bar'],
            'with port' => ['http://example.com:8080'],
        ];
    }

    #[DataProvider('invalidUrlProvider')]
    public function testInvalidUrls(mixed $url): void
    {
        self::assertFalse($this->helper->handle($url));
    }

    /**
     * @return array<string, array{mixed}>
     */
    public static function invalidUrlProvider(): array
    {
        return [
            'no scheme' => ['example.com'],
            'ftp not allowed' => ['ftp://example.com'],
            'empty' => [''],
            'null' => [null],
            'just slash' => ['/path'],
        ];
    }

    public function testCustomAllowedSchemes(): void
    {
        $helper = new IsValidUrlHelper(allowedSchemes: ['ftp']);
        self::assertTrue($helper->handle('ftp://example.com'));
        self::assertFalse($helper->handle('https://example.com'));
    }
}
