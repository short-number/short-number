<?php

declare(strict_types=1);

namespace Serhii\Tests;

use Serhii\ShortNumber\Lang;

class TestCase extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Lang::resetToDefaults();
    }

    /**
     * @param list<array{string,string,int}> $testCases
     * @return list<array{string,string,int}>
     */
    protected static function withNegativeNumbers(array $testCases, string|null $format = '-%s'): array
    {
        foreach ($testCases as $testCase) {
            [$expect, $num] = $testCase;

            if ($num === 0) {
                continue;
            }

            $config = $testCase[2] ?? null;
            $testCases[] = [sprintf($format, $expect), -$num, $config];
        }

        return $testCases;
    }
}
