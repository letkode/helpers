<?php

declare(strict_types=1);

namespace Letkode\Helpers\Tests\Array;

use Letkode\Helpers\Array\ChunkHelper;
use PHPUnit\Framework\TestCase;

final class ChunkHelperTest extends TestCase
{
    public function testChunksOfTwo(): void
    {
        $helper = new ChunkHelper(size: 2);
        $result = $helper->handle([1, 2, 3, 4, 5]);
        self::assertSame([[1, 2], [3, 4], [5]], $result);
    }

    public function testChunksWithPreservedKeys(): void
    {
        $helper = new ChunkHelper(size: 2, preserveKeys: true);
        $result = $helper->handle([10, 20, 30]);
        self::assertSame([[0 => 10, 1 => 20], [2 => 30]], $result);
    }

    public function testDefaultSizeIsOneHundred(): void
    {
        $helper = new ChunkHelper();
        $input = range(1, 150);
        $result = $helper->handle($input);
        self::assertCount(2, $result);
        self::assertCount(100, $result[0]);
        self::assertCount(50, $result[1]);
    }

    public function testEmptyArray(): void
    {
        $helper = new ChunkHelper(size: 3);
        self::assertSame([], $helper->handle([]));
    }

    public function testSizeLargerThanArray(): void
    {
        $helper = new ChunkHelper(size: 10);
        $result = $helper->handle([1, 2, 3]);
        self::assertSame([[1, 2, 3]], $result);
    }
}
