<?php

declare(strict_types=1);

namespace Serhii\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
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
        return [
            ['0', 0],
            ['999', 999],
            ['千', 1000],
            ['千', 1000],
            ['2千', 2000],
            ['3千', 3000],
            ['万', 1_0000],
            ['万', 1_9999],
            ['2万', 2_0000],
            ['11万', 11_9125],
            ['50万', 50_0321],
            ['99万', 99_9999],
            ['100万', 100_0000],
            ['億', 1_0000_0000],
            ['2億', 2_0000_0000],
            ['5億', 5_0019_3989],
            ['9億', 9_9999_9999],
            ['10億', 10_0000_0000],
            ['330億', 330_0919_6939],
            ['5002億', 5002_1919_9893],
            ['9999億', 9999_9999_9999],
            ['兆', 1_0981_3030_0931],
            ['2兆', 2_0000_0000_0000],
            ['50兆', 50_2349_2313_8230],
            ['499兆', 499_1199_0913_9399],
            ['999兆', 999_9999_9999_9999],
            ['1254兆', 1254_9399_4223_9191],
            ['京', 1_0154_8393_4253_9299],
            ['2京', 2_3154_8393_4253_9299],
            ['33京', 33_3154_8393_4253_9299],
            ['99京', 99_9054_2399_4223_9191],
            ['99京', 99_9999_9999_9999_9999],
        ];
    }
}
