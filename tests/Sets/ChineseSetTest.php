<?php

declare(strict_types=1);

namespace Serhii\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use Serhii\ShortNumber\Config;
use Serhii\ShortNumber\Lang;
use Serhii\ShortNumber\Number;

final class ChineseSetTest extends TestCase
{
    #[DataProvider('provideLanguageSet')]
    public function testLanguageSet(string $expect, int $number): void
    {
        Lang::set('zh');
        $this->assertSame($expect, Number::short($number));
    }

    public static function provideLanguageSet(): array
    {
        return self::withNegativeNumbers([
            ['0', 0],
            ['9999', 9999],
            ['999', 999],
            ['1000', 1000],
            ['2000', 2000],
            ['3000', 3000],
            ['1万', 1_0000],
            ['1.2万', 1_2000],
            ['1.2万', 1_2345],
            ['1.9万', 1_9999],
            ['2万', 2_0000],
            ['11万', 11_9125],
            ['50万', 50_0321],
            ['99万', 99_9999],
            ['100万', 100_0000],
            ['1亿', 1_0000_0000],
            ['2亿', 2_0000_0000],
            ['5亿', 5_0019_3989],
            ['9.9亿', 9_9999_9999],
            ['10亿', 10_0000_0000],
            ['330亿', 330_0919_6939],
            ['5000亿', 5002_1919_9893],
            ['9900亿', 9999_9999_9999],
            ['1.0万亿', 1_0981_3030_0931],
            ['2.0万亿', 2_0981_3030_0931],
            ['50.2万亿', 50_2349_2313_8230],
            ['499.1万亿', 499_1199_0913_9399],
            ['999.9万亿', 999_9999_9999_9999],
            ['1254.9万亿', 1254_9399_4223_9191],
            ['13154.8万亿', 1_3154_8393_4253_9299],
            ['21833.8万亿', 2_1833_8393_4253_9299],
            ['333154.8万亿', 33_3154_8393_4253_9299],
            ['999054.2万亿', 99_9054_2399_4223_9191],
            ['999999.9万亿', 99_9999_9999_9999_9999],
        ]);
    }

    #[DataProvider('provideFormattedOutput')]
    public function testFormattedOutput(
        string $expect,
        int $number,
        Config $config,
    ): void {
        Lang::set('zh');
        Number::configure($config);
        $this->assertSame($expect, Number::short($number));
    }

    public static function provideFormattedOutput(): array
    {
        return [
            ['1.2 万', 12_000, new Config(suffixSeparator: ' ')],
            ['1.2万', 12_000, new Config(decimals: 1)],
            ['1 万', 10_000, new Config(suffixSeparator: ' ')],
            ['1万', 10_000, new Config(decimals: 0)],
            ['1,2万', 12_000, new Config(decimalsSeparator: ',')],
        ];
    }
}
