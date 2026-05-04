<?php

declare(strict_types=1);

namespace Letkode\Helpers\Tests\Array;

use Letkode\Helpers\Array\DiffByKeyHelper;
use PHPUnit\Framework\TestCase;
use stdClass;

final class DiffByKeyHelperTest extends TestCase
{
    public function testReturnItemsNotInAgainst(): void
    {
        $helper = new DiffByKeyHelper('id');
        $array = [['id' => 1], ['id' => 2], ['id' => 3]];
        $against = [['id' => 2]];
        $result = $helper->handle($array, ['against' => $against]);
        self::assertCount(2, $result);
        $first = $result[0];
        self::assertIsArray($first);
        self::assertSame(1, $first['id']);
        $second = $result[1];
        self::assertIsArray($second);
        self::assertSame(3, $second['id']);
    }

    public function testEmptyAgainstReturnsAll(): void
    {
        $helper = new DiffByKeyHelper('id');
        $array = [['id' => 1], ['id' => 2]];
        $result = $helper->handle($array, ['against' => []]);
        self::assertCount(2, $result);
    }

    public function testAllMatchedReturnsEmpty(): void
    {
        $helper = new DiffByKeyHelper('id');
        $array = [['id' => 1], ['id' => 2]];
        $against = [['id' => 1], ['id' => 2]];
        self::assertSame([], $helper->handle($array, ['against' => $against]));
    }

    public function testWorksWithObjects(): void
    {
        $helper = new DiffByKeyHelper('id');
        $a = new stdClass();
        $a->id = 1;
        $b = new stdClass();
        $b->id = 2;
        $x = new stdClass();
        $x->id = 1;
        $result = $helper->handle([$a, $b], ['against' => [$x]]);
        self::assertCount(1, $result);
        $item = $result[0];
        self::assertInstanceOf(stdClass::class, $item);
        self::assertSame(2, $item->id);
    }

    public function testNoAgainstParameterReturnsAll(): void
    {
        $helper = new DiffByKeyHelper('id');
        $array = [['id' => 1]];
        self::assertCount(1, $helper->handle($array));
    }
}
