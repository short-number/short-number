<?php

declare(strict_types=1);

namespace Serhii\Tests;

use Serhii\ShortNumber\Lang;
use Serhii\ShortNumber\Number;
use Serhii\ShortNumber\Rule;

class TestCase extends \PHPUnit\Framework\TestCase
{
    public function runTestsForSuffixes(string $lang, array $suffixes): void
    {
        Lang::set($lang);

        [$k, $m, $b, $t] = $suffixes;

        $_ = $this->generateDataForProvider(0, Rule::THOUSAND - 1);
        $K = $this->generateDataForProvider(Rule::THOUSAND, Rule::MILLION - 1);
        $M = $this->generateDataForProvider(Rule::MILLION, Rule::BILLION - 1);
        $B = $this->generateDataForProvider(Rule::BILLION, Rule::TRILLION - 1);
        $T = $this->generateDataForProvider(Rule::TRILLION, Rule::QUADRILLION - 1);

        for ($i = 0, $count = count($K); $i < $count; $i++) {
            $this->assertEquals($_[$i]['expect'], Number::conv($inp = $_[$i]['input']), "Failed on test #{$inp}");
            $this->assertEquals("{$K[$i]['expect']}$k", Number::conv($inp = $K[$i]['input']), "Failed on test #{$inp}");
            $this->assertEquals("{$M[$i]['expect']}$m", Number::conv($inp = $M[$i]['input']), "Failed on test #{$inp}");
            $this->assertEquals("{$B[$i]['expect']}$b", Number::conv($inp = $B[$i]['input']), "Failed on test #{$inp}");
            $this->assertEquals("{$T[$i]['expect']}$t", Number::conv($inp = $T[$i]['input']), "Failed on test #{$inp}");
        }
    }

    /**
     * @param int $from
     * @param int $to
     * @return array
     */
    protected function generateDataForProvider(int $from, int $to): array
    {
        $data = [];
        $add = (int) floor(($to - $from) / 100);
        $subtract = mb_strlen(mb_substr((string) $from, 0, -1));

        for ($i = $from; $i < $to; $i += $add) {
            if ($i >= 0 && $i < Rule::THOUSAND) {
                $data[] = ['input' => $i, 'expect' => (string) $i];
            } else {
                $data[] = [
                    'input' => $i,
                    'expect' => mb_substr((string) $i, 0, -$subtract),
                ];
            }
        }

        return $data;
    }
}
