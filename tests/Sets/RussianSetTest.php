<?php

declare(strict_types=1);

namespace Serhii\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use Serhii\ShortNumber\Lang;
use Serhii\ShortNumber\Number;

final class RussianSetTest extends TestCase
{
    #[DataProvider('provideLanguageSet')]
    public function testLanguageSet(string $expect, int $number): void
    {
        Lang::set('ru');
        $this->assertSame($expect, Number::short($number));
    }

    public static function provideLanguageSet(): array
    {
        return self::withNegativeNumbers([
            ['0', 0],
            ['999', 999],
            ['1тыс', 1_000],
            ['2тыс', 2_000],
            ['10тыс', 10_999],
            ['19тыс', 19_999],
            ['119тыс', 119_125],
            ['500тыс', 500_321],
            ['999тыс', 999_999],
            ['1млн', 1_000_000],
            ['500млн', 500_193_989],
            ['999млн', 999_999_999],
            ['1млд', 1_000_000_000],
            ['33млд', 33_009_196_939],
            ['500млд', 500_219_199_893],
            ['999млд', 999_999_999_999],
            ['1трн', 1_098_130_300_931],
            ['50трн', 50_234_923_138_230],
            ['499трн', 499_119_909_139_399],
            ['999трн', 999_999_999_999_999],
            ['1квадр', 1_254_939_942_239_191],
            ['333квадр', 333_154_839_342_539_299],
            ['999квадр', 999_054_239_942_239_191],
            ['999квадр', 999_999_999_999_999_999],
        ]);
    }
}
