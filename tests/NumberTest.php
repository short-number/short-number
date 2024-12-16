<?php

declare(strict_types=1);

namespace Serhii\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use Serhii\ShortNumber\Lang;
use Serhii\ShortNumber\Number;

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
        $testCases = [
            ['1k', 'en', 1234],
            ['4k', 'en', 4367],
            ['5m', 'en', 5_935_235],
            ['81m', 'en', 81_235_678],
            ['3b', 'en', 3_456_789_012],
            ['25b', 'en', 25_256_365_947],
            ['91t', 'en', 91_345_678_912_345],
            ['4q', 'en', 4_091_345_678_912_345],
            ['13t', 'en', 13_000_000_000_000],
            ['21t', 'en', 21_256_365_947_295],
        ];

        return self::addNegativeNumbers($testCases);
    }

    /**
     * @param list<array{string,string,int}> $testCases
     * @return list<array{string,string,int}>
     */
    private static function addNegativeNumbers(array $testCases): array
    {
        foreach ($testCases as $testCase) {
            [$expect, $lang, $num] = $testCase;
            $testCases[] = ["-{$expect}", $lang, -$num];
        }

        return $testCases;
    }
}
