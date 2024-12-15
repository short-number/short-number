<?php

declare(strict_types=1);

namespace Serhii\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use Serhii\ShortNumber\Lang;
use Serhii\ShortNumber\Number;
use Serhii\ShortNumber\NumberShortener;

final class NumberTest extends TestCase
{
    #[DataProvider('providerForNumbers')]
    public function testNumber(string $expect, string $lang, int $num): void
    {
        Lang::set($lang);
        $this->assertSame($expect, Number::conv($num));
    }

    public static function providerForNumbers(): array
    {
        return [
            ['1k', 'en', 1234],
            ['81m', 'en', 81_235_678],
            ['3b', 'en', 3_456_789_012],
            ['91t', 'en', 91_345_678_912_345],
            ['4q', 'en', 4_091_345_678_912_345],
            ['-1k', 'en', -NumberShortener::THOUSAND],
            ['-3m', 'en', -NumberShortener::MILLION * 3],
            ['-1b', 'en', -NumberShortener::BILLION],
            ['-6t', 'en', -NumberShortener::TRILLION * 6],
            ['-1тыс', 'ru', -NumberShortener::THOUSAND],
            ['-1млн', 'ru', -NumberShortener::MILLION],
            ['-1млд', 'ru', -NumberShortener::BILLION],
            ['-1трн', 'ru', -NumberShortener::TRILLION],
        ];
    }
}
