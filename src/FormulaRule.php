<?php

declare(strict_types=1);

namespace Serhii\ShortNumber;

use InvalidArgumentException;

final class FormulaRule
{
    /**
     * @param int $inputDigits Number of digits in inputs matched by this rule.
     * @param int $integerDigits Digits retained before the decimal separator.
     * @param string $suffix Abbreviation appended to the formatted number.
     * @param int|null $significantDigits Number of digits to retain when `Config::decimals` is not set.
     * @param int $minimumFractionDigits Minimum fractional digits to display.
     */
    public function __construct(
        public readonly int $inputDigits,
        public readonly int $integerDigits,
        public readonly string $suffix,
        public readonly int|null $significantDigits = null,
        public readonly int $minimumFractionDigits = 0,
    ) {
        if ($this->integerDigits < 1) {
            throw new InvalidArgumentException('integerDigits must be at least 1');
        }
    }

    public function formatNumber(string $number, Config $config): string
    {
        if (!$this->usesSignificantDigits($config)) {
            return $this->scaleWithConfiguredDecimals($number, $config);
        }

        return $this->scaleWithSignificantDigits($number, $config);
    }

    private function usesSignificantDigits(Config $config): bool
    {
        return $this->significantDigits !== null && !$config->decimalsConfigured;
    }

    private function scaleWithSignificantDigits(string $number, Config $config): string
    {
        $scaledDigits = $this->getScaledDigits($number);

        $integerPart = substr($scaledDigits, 0, $this->integerDigits);
        $fractionPart = rtrim(substr($scaledDigits, $this->integerDigits), '0');
        $fractionPart = str_pad($fractionPart, $this->minimumFractionDigits, '0', STR_PAD_RIGHT);

        if ($fractionPart === '') {
            return $integerPart;
        }

        return $integerPart . $config->decimalsSeparator . $fractionPart;
    }

    private function getScaledDigits(string $number): string
    {
        $retainedDigits = substr($number, 0, $this->significantDigits);
        $numberOfTrailingZeros = max(0, strlen($number) - $this->significantDigits);

        return $retainedDigits . str_repeat('0', $numberOfTrailingZeros);
    }

    private function scaleWithConfiguredDecimals(string $number, Config $config): string
    {
        $integerPart = substr($number, 0, $this->integerDigits);

        if ($config->decimals === 0) {
            return $integerPart;
        }

        $fractionPart = substr($number, $this->integerDigits, $config->decimals);

        return sprintf(
            '%s%s%s',
            $integerPart,
            $config->decimalsSeparator,
            $fractionPart,
        );
    }
}
