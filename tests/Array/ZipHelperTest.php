<?php

declare(strict_types=1);

namespace Letkode\Helpers\Tests\Array;

use Letkode\Helpers\Array\ZipHelper;
use PHPUnit\Framework\TestCase;

final class ZipHelperTest extends TestCase
{
    private ZipHelper $helper;

    protected function setUp(): void
    {
        $this->helper = new ZipHelper();
    }

    public function testZipsKeysAndValues(): void
    {
        $result = $this->helper->handle(['a', 'b', 'c'], ['with' => [1, 2, 3]]);
        self::assertSame(['a' => 1, 'b' => 2, 'c' => 3], $result);
    }

    public function testTruncatesToShorterArray(): void
    {
        $result = $this->helper->handle(['a', 'b', 'c'], ['with' => [1, 2]]);
        self::assertSame(['a' => 1, 'b' => 2], $result);
    }

    public function testTruncatesToShorterKeys(): void
    {
        $result = $this->helper->handle(['a'], ['with' => [1, 2, 3]]);
        self::assertSame(['a' => 1], $result);
    }

    public function testEmptyArrays(): void
    {
        self::assertSame([], $this->helper->handle([], ['with' => []]));
    }

    public function testMissingWithParameterReturnsEmpty(): void
    {
        self::assertSame([], $this->helper->handle(['a', 'b']));
    }
}
