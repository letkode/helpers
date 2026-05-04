<?php

declare(strict_types=1);

namespace Letkode\Helpers\Tests\Array;

use Letkode\Helpers\Array\FlattenHelper;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class FlattenHelperTest extends TestCase
{
    private FlattenHelper $helper;

    protected function setUp(): void
    {
        $this->helper = new FlattenHelper();
    }

    /**
     * @param array<mixed> $input
     * @param array<mixed> $expected
     */
    #[DataProvider('flattenProvider')]
    public function testHandle(array $input, array $expected): void
    {
        self::assertSame($expected, $this->helper->handle($input));
    }

    /**
     * @return array<string, array{array<mixed>, array<mixed>}>
     */
    public static function flattenProvider(): array
    {
        return [
            'flat array' => [[1, 2, 3], [1, 2, 3]],
            'nested one level' => [[1, [2, 3]], [1, 2, 3]],
            'nested deep' => [[1, [2, [3, [4]]]], [1, 2, 3, 4]],
            'mixed types' => [['a', [1, true]], ['a', 1, true]],
            'empty' => [[], []],
            'all nested strings' => [['a', ['b', ['c']]], ['a', 'b', 'c']],
        ];
    }

    public function testParametersArgumentIsIgnored(): void
    {
        $result = $this->helper->handle([1, [2]], ['ignored' => true]);
        self::assertSame([1, 2], $result);
    }
}
