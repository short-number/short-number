<?php

declare(strict_types=1);

namespace Serhii\Tests;

use InvalidArgumentException;
use Serhii\ShortNumber\Config;
use Serhii\ShortNumber\FormulaRule;

final class FormulaRuleTest extends TestCase
{
    public function testTruncatesToSignificantDigitsUsingConfiguredSeparator(): void
    {
        $rule = new FormulaRule(
            inputDigits: 5,
            integerDigits: 1,
            suffix: '万',
            significantDigits: 2,
        );

        $actual = $rule->formatNumber('19999', new Config(decimalsSeparator: ','));

        $this->assertSame('1,9', $actual);
    }

    public function testKeepsMinimumFractionDigits(): void
    {
        $rule = new FormulaRule(
            inputDigits: 13,
            integerDigits: 1,
            suffix: '万亿',
            significantDigits: 2,
            minimumFractionDigits: 1,
        );

        $this->assertSame('1.0', $rule->formatNumber('1098130300931', new Config()));
    }

    public function testExplicitDecimalsOverrideSignificantDigits(): void
    {
        $rule = new FormulaRule(
            inputDigits: 5,
            integerDigits: 1,
            suffix: '万',
            significantDigits: 2,
        );

        $this->assertSame('1.99', $rule->formatNumber('19999', new Config(decimals: 2)));
    }

    public function testExplicitZeroDecimalsDisableSignificantDigits(): void
    {
        $rule = new FormulaRule(
            inputDigits: 5,
            integerDigits: 1,
            suffix: '万',
            significantDigits: 2,
        );

        $this->assertSame('1', $rule->formatNumber('19999', new Config(decimals: 0)));
    }

    public function testUsesConfiguredDecimalsWhenSignificantDigitsAreNotSet(): void
    {
        $rule = new FormulaRule(
            inputDigits: 5,
            integerDigits: 2,
            suffix: '万',
        );

        $this->assertSame('12.34', $rule->formatNumber('12345', new Config(decimals: 2)));
    }

    public function testReturnsIntegerWhenSignificantDigitsDoNotIncludeFractionalDigits(): void
    {
        $rule = new FormulaRule(
            inputDigits: 5,
            integerDigits: 1,
            suffix: '万',
            significantDigits: 1,
        );

        $this->assertSame('1', $rule->formatNumber('19999', new Config()));
    }

    public function testTrimsTrailingZerosFromFraction(): void
    {
        $rule = new FormulaRule(
            inputDigits: 5,
            integerDigits: 1,
            suffix: '万',
            significantDigits: 3,
        );

        $this->assertSame('1.2', $rule->formatNumber('12000', new Config()));
    }

    public function testPadsZeroFractionToMinimumLength(): void
    {
        $rule = new FormulaRule(
            inputDigits: 5,
            integerDigits: 1,
            suffix: '万',
            significantDigits: 1,
            minimumFractionDigits: 2,
        );

        $this->assertSame('1.00', $rule->formatNumber('10000', new Config()));
    }

    public function testPreservesFractionDigitsBeyondMinimumLength(): void
    {
        $rule = new FormulaRule(
            inputDigits: 5,
            integerDigits: 1,
            suffix: '万',
            significantDigits: 3,
            minimumFractionDigits: 1,
        );

        $this->assertSame('1.23', $rule->formatNumber('12345', new Config()));
    }

    public function testUsesConfiguredSeparatorWithExplicitDecimals(): void
    {
        $rule = new FormulaRule(
            inputDigits: 5,
            integerDigits: 2,
            suffix: '万',
        );

        $actual = $rule->formatNumber('12345', new Config(decimals: 2, decimalsSeparator: ','));

        $this->assertSame('12,34', $actual);
    }

    public function testRejectsZeroLeadingDigits(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('integerDigits must be at least 1');

        new FormulaRule(
            inputDigits: 5,
            integerDigits: 0,
            suffix: '万',
        );
    }
}
