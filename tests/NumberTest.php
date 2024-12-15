<?php

declare(strict_types=1);

namespace Serhii\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use Serhii\ShortNumber\Lang;
use Serhii\ShortNumber\Number;
use Serhii\ShortNumber\NumberShortener;

final class NumberTest extends TestCase
{
    public function testItDefaultsToEnglishLanguageIfLanguageIsNotSet(): void
    {
        $this->assertEquals('1k', Number::conv(NumberShortener::THOUSAND));
        $this->assertEquals('1m', Number::conv(NumberShortener::MILLION));
        $this->assertEquals('1b', Number::conv(NumberShortener::BILLION));
        $this->assertEquals('1t', Number::conv(NumberShortener::TRILLION));
    }

    #[DataProvider('providerForItCanConvertNegativeNumbers')]
    public function testItCanConvertNegativeNumbers(string $expect, string $lang, int $input): void
    {
        Lang::set($lang);
        $this->assertEquals($expect, Number::conv($input));
    }

    public static function providerForItCanConvertNegativeNumbers(): array
    {
        return [
            ['-1k', 'en', -NumberShortener::THOUSAND],
            ['-1m', 'en', -NumberShortener::MILLION],
            ['-1b', 'en', -NumberShortener::BILLION],
            ['-1t', 'en', -NumberShortener::TRILLION],
            ['-1тыс', 'ru', -NumberShortener::THOUSAND],
            ['-1млн', 'ru', -NumberShortener::MILLION],
            ['-1млд', 'ru', -NumberShortener::BILLION],
            ['-1трн', 'ru', -NumberShortener::TRILLION],
        ];
    }
}
