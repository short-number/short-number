<?php

declare(strict_types=1);

namespace Serhii\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use Serhii\ShortNumber\Lang;
use Serhii\ShortNumber\Number;

final class LangTest extends TestCase
{
    /**
     * @param array<string,string> $overwrites
     */
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
            ['2', 2000, ['k' => '']],
            ['33k', 33000, ['k' => 'k']],
            ['A kilo', 1000, ['1k' => 'A kilo']],
            ['123 kilo', 123456, ['k' => ' kilo']],
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
            ['10 тысяч', 10000, 'ru', ['ru' => ['10тыс' => '10 тысяч']]],
            ['9тыс', 9000, 'ru', ['ru' => ['10тыс' => '10 тысяч']]],
        ];
    }
}
