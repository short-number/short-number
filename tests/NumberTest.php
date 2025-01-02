<?php

declare(strict_types=1);

namespace Serhii\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use Serhii\ShortNumber\Config;
use Serhii\ShortNumber\Exceptions\LargeNumberException;
use Serhii\ShortNumber\Number;

final class NumberTest extends TestCase
{
    #[DataProvider('provideNumberShort')]
    public function testNumberShort(string $expect, int $num, Config|null $config = null): void
    {
        Number::configure($config ?? new Config());
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

            // Test with Configurations
            ['5m', 5_935_235, new Config(decimals: 0)],
            ['5.9m', 5_935_235, new Config(decimals: 1)],
            ['8.135m', 8_135_235, new Config(decimals: 3)],
            ['1__10m', 1_105_000, new Config(decimals: 2, decimalsSeparator: '__')],
            ['8 m', 8_135_235, new Config(suffixSeparator: ' ')],
            ['3--b', 3_456_789_012, new Config(suffixSeparator: '--')],
            ['91T', 91_345_678_912_345, new Config(upperCase: true)],
            ['91t', 91_345_678_912_345, new Config(upperCase: false)],
            ['999 T', 999_999_999_999_999, new Config(upperCase: true, suffixSeparator: ' ')],
            ['5,9M', 5_935_235, new Config(decimals: 1, upperCase: true, decimalsSeparator: ',')],
        ]);
    }

    public function testLargeNumberExceptionIsThrown(): void
    {
        $this->expectException(LargeNumberException::class);
        Number::short(1_000_000_000_000_000_000);
    }
}
