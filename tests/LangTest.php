<?php

declare(strict_types=1);

namespace Serhii\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use Serhii\ShortNumber\Lang;
use Serhii\ShortNumber\Number;

final class LangTest extends TestCase
{
    #[DataProvider('provideCurrentLanguageOverwrites')]
    public function testCurrentLanguageOverwrites(string $expect, int $number, array $overwrites): void
    {
        Lang::set('en', overwrites: $overwrites);
        $this->assertSame($expect, Number::short($number));
    }

    public static function provideCurrentLanguageOverwrites(): array
    {
        return [
            ['1kilo', 1000, ['k' => 'kilo']],
            ['33k', 33000, ['k' => 'k']],
            ['123 kilo', 123456, ['k' => ' kilo']],
            ['-1kilo', -1123, ['k' => 'kilo']],
            ['-33k', -33193, ['k' => 'k']],
            ['-123 kilo', -123654, ['k' => ' kilo']],
        ];
    }

    #[DataProvider('provideSetOverwrites')]
    public function testSetOverwrites(string $expect, int $number, string $lang, array $overwrites): void
    {
        Lang::set($lang);
        Lang::setOverwrites($overwrites);
        $this->assertSame($expect, Number::short($number));
    }

    public static function provideSetOverwrites(): array
    {
        return [
            ['1kilo', 1000, 'en', ['en' => ['k' => 'kilo']]],
            ['2тыс', 2000, 'ru', ['en' => ['k' => '']]],
            ['11т', 11000, 'ru', ['en' => ['k' => 'k'], 'ru' => ['тыс' => 'т']]],
            ['10 тысяч', 10000, 'ru', ['ru' => ['тыс' => ' тысяч']]],
            ['9', 9000, 'ru', ['ru' => ['тыс' => '']]],
            ['-1kilo', -1000, 'en', ['en' => ['k' => 'kilo']]],
            ['-2тыс', -2999, 'ru', ['en' => ['k' => '']]],
            ['-11т', -11111, 'ru', ['en' => ['k' => 'k'], 'ru' => ['тыс' => 'т']]],
            ['-10 тысяч', -10923, 'ru', ['ru' => ['тыс' => ' тысяч']]],
            ['-9', -9923, 'ru', ['ru' => ['тыс' => '']]],
        ];
    }

    public function testEmptyArrayOverwritesReplaceExistingSuffixes(): void
    {
        Lang::set('en', overwrites: ['k' => 'thousand']);
        $this->assertSame('1thousand', Number::short(1000));

        Lang::set('en', overwrites: []);
        $this->assertSame('1k', Number::short(1000));
    }

    public function testSetWithoutOverwritesLeavesPreviousOverwrites(): void
    {
        Lang::set('en', overwrites: ['k' => 'thousand']);
        Lang::set('en');
        $this->assertSame('1thousand', Number::short(1000));
    }

    #[DataProvider('providerForUnsupportedLanguagesAreRejected')]
    public function testUnsupportedLanguagesAreRejected(string $lang): void
    {
        Lang::set($lang);

        $this->expectException(InvalidArgumentException::class);
        Number::short(1000);
    }

    public static function providerForUnsupportedLanguagesAreRejected(): array
    {
        return [
            ['../sets/zh'],
            ['zz'],
        ];
    }
}
