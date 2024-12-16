<?php

declare(strict_types=1);

namespace Serhii\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use Serhii\ShortNumber\Number;

final class NumberTest extends TestCase
{
    #[DataProvider('providerForNumbers')]
    public function testNumber(string $expect, int $num): void
    {
        $this->assertSame($expect, Number::conv($num));
    }

    public static function providerForNumbers(): array
    {
        $testCases = [
            ['1k', 1234],
            ['4k', 4367],
            ['5m', 5_935_235],
            ['81m', 81_235_678],
            ['3b', 3_456_789_012],
            ['25b', 25_256_365_947],
            ['91t', 91_345_678_912_345],
            ['4q', 4_091_345_678_912_345],
            ['13t', 13_000_000_000_000],
            ['21t', 21_256_365_947_295],
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
            [$expect, $num] = $testCase;
            $testCases[] = ["-{$expect}", -$num];
        }

        return $testCases;
    }
}
