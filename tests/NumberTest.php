<?php

declare(strict_types=1);

namespace Serhii\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use Serhii\ShortNumber\Exceptions\LargeNumberException;
use Serhii\ShortNumber\Number;

final class NumberTest extends TestCase
{
    #[DataProvider('provideNumberShort')]
    public function testNumberShort(string $expect, int $num): void
    {
        $this->assertSame($expect, Number::short($num));
    }

    public static function provideNumberShort(): array
    {
        return self::withNegativeNumbers([
            ['0', 0],
            ['1', 1],
            ['500', 500],
            ['999', 999],
            ['1k', 1000],
            ['1k', 1001],
            ['1k', 1234],
            ['4k', 4367],
            ['5m', 5_935_235],
            ['81m', 81_235_678],
            ['3b', 3_456_789_012],
            ['25b', 25_256_365_947],
            ['91t', 91_345_678_912_345],
            ['999t', 999_999_999_999_999],
            ['13t', 13_000_000_000_000],
            ['21t', 21_256_365_947_295],
            ['1q', 1_000_000_000_000_000],
            ['4q', 4_091_345_678_912_345],
            ['10q', 10_000_000_000_000_000],
            ['999q', 999_999_999_999_999_999],
        ]);
    }

    public function testLargeNumberExceptionIsThrown(): void
    {
        $this->expectException(LargeNumberException::class);
        Number::short(1_000_000_000_000_000_000);
    }
}
