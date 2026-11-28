<?php

declare(strict_types=1);

namespace Serhii\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use Serhii\ShortNumber\Config;
use Serhii\ShortNumber\Lang;
use Serhii\ShortNumber\Number;

final class JapaneseSetTest extends TestCase
{
    #[DataProvider('provideLanguageSet')]
    public function testLanguageSet(string $expect, int $number): void
    {
        Lang::set('ja');
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
            ['1.9万', 1_9999],
            ['1.2万', 1_2000],
            ['1.2万', 1_2345],
            ['2万', 2_0000],
            ['11万', 11_9125],
            ['50万', 50_0321],
            ['99万', 99_9999],
            ['100万', 100_0000],
            ['1億', 1_0000_0000],
            ['2億', 2_0000_0000],
            ['5億', 5_0019_3989],
            ['9.9億', 9_9999_9999],
            ['10億', 10_0000_0000],
            ['330億', 330_0919_6939],
            ['5000億', 5002_1919_9893],
            ['9900億', 9999_9999_9999],
            ['1兆', 1_0981_3030_0931],
            ['2兆', 2_0000_0000_0000],
            ['50兆', 50_2349_2313_8230],
            ['490兆', 499_1199_0913_9399],
            ['990兆', 999_9999_9999_9999],
            ['1200兆', 1254_9399_4223_9191],
            ['1兆', 1_0000_0000_0000],
            ['10兆', 10_0000_0000_0000],
            ['1.3京', 1_3154_8393_4253_9299],
            ['2.3京', 2_3154_8393_4253_9299],
            ['33京', 33_3154_8393_4253_9299],
            ['99京', 99_9054_2399_4223_9191],
            ['99京', 99_9999_9999_9999_9999],
        ]);
    }

    #[DataProvider('provideFormattedOutput')]
    public function testFormattedOutput(
        string $expect,
        int $number,
        Config $config,
    ): void {
        Lang::set('ja');
        Number::configure($config);
        $this->assertSame($expect, Number::short($number));
    }

    public static function provideFormattedOutput(): array
    {
        return [
            ['1.2 万', 12_000, new Config(suffixSeparator: ' ')],
            ['-1.2 万', -12_000, new Config(suffixSeparator: ' ')],
            ['1.2 万', 12_000, new Config(decimals: 1, suffixSeparator: ' ')],
            ['-1.2 万', -12_345, new Config(decimals: 1, suffixSeparator: ' ')],
            ['1万', 10_000, new Config(decimals: 0)],
        ];
    }
}
