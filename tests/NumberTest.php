<?php

declare(strict_types=1);

namespace Serhii\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use Serhii\ShortNumber\Lang;
use Serhii\ShortNumber\Number;
use Serhii\ShortNumber\Rule;

final class NumberTest extends TestCase
{
    public function testItDefaultsToEnglishLanguageIfLanguageIsNotSet(): void
    {
        $this->assertEquals('1k', Number::conv(Rule::THOUSAND));
        $this->assertEquals('1m', Number::conv(Rule::MILLION));
        $this->assertEquals('1b', Number::conv(Rule::BILLION));
        $this->assertEquals('1t', Number::conv(Rule::TRILLION));
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
            ['-1k', 'en', -Rule::THOUSAND],
            ['-1m', 'en', -Rule::MILLION],
            ['-1b', 'en', -Rule::BILLION],
            ['-1t', 'en', -Rule::TRILLION],
            ['-1тыс', 'ru', -Rule::THOUSAND],
            ['-1млн', 'ru', -Rule::MILLION],
            ['-1млд', 'ru', -Rule::BILLION],
            ['-1трн', 'ru', -Rule::TRILLION],
        ];
    }
}
