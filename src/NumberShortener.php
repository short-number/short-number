<?php

declare(strict_types=1);

namespace Serhii\ShortNumber;

use Serhii\ShortNumber\Exceptions\LargeNumberException;

final class NumberShortener
{
    public const THOUSAND = 10 ** 3; // 1,000
    public const MILLION = 10 ** 6; // 1,000,000
    public const BILLION = 10 ** 9; // 1,000,000,000
    public const TRILLION = 10 ** 12; // 1,000,000,000,000
    public const QUADRILLION = 10 ** 15; // 1,000,000,000,000,000
    public const QUINTILLION = 10 ** 18; // 1,000,000,000,000,000,000

    public function __construct(
        private readonly int $number,
        private readonly AbbreviationSet $set,
    ) {
    }

    public function shorten(): string
    {
        if ($this->number < self::THOUSAND) {
            return (string) $this->number;
        }

        $suffix = $this->getSuffix();

        $shortNumber = explode(',', number_format((float) $this->number))[0];

        return $shortNumber . $suffix;
    }

    /**
     * Check if given value is in the certain number range.
     * For example, a thousand must be in range between
     * 1000 (included) and 999,999 (included).
     */
    public function inRange(int $min): bool
    {
        $max = $min * 1000 - 1;
        return $this->number >= $min && $this->number <= $max;
    }

    /**
     * Returns number suffix like 'k', 'm', 'b', etc. based on the
     * given number and language set property.
     */
    private function getSuffix(): string
    {
        return match (true) {
            $this->inRange(self::THOUSAND) => $this->set->thousand,
            $this->inRange(self::MILLION) => $this->set->million,
            $this->inRange(self::BILLION) => $this->set->billion,
            $this->inRange(self::TRILLION) => $this->set->trillion,
            $this->inRange(self::QUADRILLION) => $this->set->quadrillion,
            default => throw new LargeNumberException($this->number),
        };
    }
}
