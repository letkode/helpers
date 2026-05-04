<?php

declare(strict_types=1);

namespace Letkode\Helpers\Tests\String;

use Letkode\Helpers\String\TruncateByWordsHelper;
use PHPUnit\Framework\TestCase;

final class TruncateByWordsHelperTest extends TestCase
{
    public function testNoTruncationWhenUnderLimit(): void
    {
        $helper = new TruncateByWordsHelper(maxWords: 5);
        $input = 'one two three';
        self::assertSame($input, $helper->handle($input));
    }

    public function testTruncatesAtWordBoundary(): void
    {
        $helper = new TruncateByWordsHelper(maxWords: 3);
        $result = $helper->handle('one two three four five');
        self::assertSame('one two three...', $result);
    }

    public function testCustomSuffix(): void
    {
        $helper = new TruncateByWordsHelper(maxWords: 2, suffix: ' [more]');
        $result = $helper->handle('alpha beta gamma');
        self::assertSame('alpha beta [more]', $result);
    }

    public function testExactLimitNotTruncated(): void
    {
        $helper = new TruncateByWordsHelper(maxWords: 3);
        $input = 'one two three';
        self::assertSame($input, $helper->handle($input));
    }

    public function testEmptyString(): void
    {
        $helper = new TruncateByWordsHelper(maxWords: 5);
        self::assertSame('', $helper->handle(''));
    }

    public function testDefaultMaxWords(): void
    {
        $helper = new TruncateByWordsHelper();
        $input = implode(' ', range(1, 20));
        self::assertSame($input, $helper->handle($input));
        $input21 = $input . ' 21';
        self::assertStringEndsWith('...', $helper->handle($input21));
    }
}
