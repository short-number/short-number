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
    #[DataProvider('providerForOverwrites')]
    public function testOverwrites(string $expect, int $number, array $overwrites): void
    {
        Lang::set('en', overwrites: $overwrites);
        $this->assertSame($expect, Number::short($number));
    }

    public static function providerForOverwrites(): array
    {
        return [
            ['1kilo', 1000, ['k' => 'kilo']],
            ['2', 2000, ['k' => '']],
            ['33k', 33000, ['k' => 'k']],
            ['A kilo', 1000, ['1k' => 'A kilo']],
            ['123 kilo', 123456, ['k' => ' kilo']],
        ];
    }
}
