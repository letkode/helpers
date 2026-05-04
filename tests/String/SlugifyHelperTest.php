<?php

declare(strict_types=1);

namespace Letkode\Helpers\Tests\String;

use Letkode\Helpers\String\SlugifyHelper;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class SlugifyHelperTest extends TestCase
{
    #[DataProvider('slugProvider')]
    public function testHandle(string $input, string $expected): void
    {
        $helper = new SlugifyHelper();
        self::assertSame($expected, $helper->handle($input));
    }

    /**
     * @return array<string, array{string, string}>
     */
    public static function slugProvider(): array
    {
        return [
            'simple ascii' => ['Hello World', 'hello-world'],
            'accented chars' => ['Héllo Wörld', 'hello-world'],
            'special chars' => ['foo@bar!baz', 'foo-bar-baz'],
            'multiple spaces' => ['foo   bar', 'foo-bar'],
            'leading/trailing' => ['--hello--', 'hello'],
            'numbers' => ['PHP 8.4 release', 'php-8-4-release'],
        ];
    }

    public function testCustomSeparator(): void
    {
        $helper = new SlugifyHelper(separator: '_');
        self::assertSame('hello_world', $helper->handle('Hello World'));
    }

    public function testEmptyStringReturnsNa(): void
    {
        $helper = new SlugifyHelper();
        self::assertSame('n-a', $helper->handle(''));
    }

    public function testEmptyStringWithNullableReturnsEmpty(): void
    {
        $helper = new SlugifyHelper(nullable: true);
        self::assertSame('', $helper->handle(''));
    }

    public function testOnlySpecialCharsResultIsNa(): void
    {
        $helper = new SlugifyHelper();
        self::assertSame('n-a', $helper->handle('!!!'));
    }
}
