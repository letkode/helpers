<?php

declare(strict_types=1);

namespace Letkode\Helpers\Tests\Array;

use Letkode\Helpers\Array\UniqueByKeyHelper;
use PHPUnit\Framework\TestCase;
use stdClass;

final class UniqueByKeyHelperTest extends TestCase
{
    public function testDeduplicatesAssociativeArrays(): void
    {
        $helper = new UniqueByKeyHelper('id');
        $input = [
            ['id' => 1, 'name' => 'Alice'],
            ['id' => 2, 'name' => 'Bob'],
            ['id' => 1, 'name' => 'Alice Duplicate'],
        ];
        $result = $helper->handle($input);
        self::assertCount(2, $result);
        $first = $result[0];
        self::assertIsArray($first);
        self::assertSame('Alice', $first['name']);
    }

    public function testDeduplicatesObjects(): void
    {
        $helper = new UniqueByKeyHelper('id');
        $a = new stdClass();
        $a->id = 1;
        $b = new stdClass();
        $b->id = 2;
        $c = new stdClass();
        $c->id = 1;
        $result = $helper->handle([$a, $b, $c]);
        self::assertCount(2, $result);
    }

    public function testKeepsFirstOccurrence(): void
    {
        $helper = new UniqueByKeyHelper('val');
        $input = [
            ['val' => 'x', 'order' => 1],
            ['val' => 'x', 'order' => 2],
        ];
        $result = $helper->handle($input);
        $first = $result[0];
        self::assertIsArray($first);
        self::assertSame(1, $first['order']);
    }

    public function testEmptyArray(): void
    {
        $helper = new UniqueByKeyHelper('id');
        self::assertSame([], $helper->handle([]));
    }

    public function testMissingKeyTreatedAsNull(): void
    {
        $helper = new UniqueByKeyHelper('missing');
        $input = [['a' => 1], ['b' => 2], ['c' => 3]];
        $result = $helper->handle($input);
        self::assertCount(1, $result);
    }
}
