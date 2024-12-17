<?php

declare(strict_types=1);

namespace Serhii\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use Serhii\ShortNumber\Lang;
use Serhii\ShortNumber\Number;

final class EnglishSetTest extends TestCase
{
    #[DataProvider('provideEnglishSet')]
    public function testEnglishSet(string $expect, int $number): void
    {
        Lang::set('en');
        $this->assertSame($expect, Number::short($number));
    }

    public static function provideEnglishSet(): array
    {
        return [
            ['999', 999],
            ['1k', 1_000],
            ['2k', 2_000],
            ['10k', 10_999],
            ['19k', 19_999],
            ['119k', 119_125],
            ['500k', 500_321],
            ['999k', 999_999],
            ['1m', 1_000_000],
            ['500m', 500_193_989],
            ['999m', 999_999_999],
            ['1b', 1_000_000_000],
            ['33b', 33_009_196_939],
            ['500b', 500_219_199_893],
            ['999b', 999_999_999_999],
            ['1t', 1_098_130_300_931],
            ['50t', 50_234_923_138_230],
            ['499t', 499_119_909_139_399],
            ['999t', 999_999_999_999_999],
            ['1q', 1_254_939_942_239_191],
            ['333q', 333_154_839_342_539_299],
            ['999q', 999_054_239_942_239_191],
            ['999q', 999_999_999_999_999_999],
        ];
    }
}
