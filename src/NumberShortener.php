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

    public function __construct(
        private readonly int $number,
        private readonly AbbreviationSet $set,
    ) {
    }

    /**
     * @throws LargeNumberException
     */
    public function shorten(): string
    {
        if ($this->number < self::THOUSAND) {
            return (string) $this->number;
        }

        $inputNumber = (string) $this->number;
        $digits = strlen($inputNumber);

        $formulaItem = $this->set->formula[$digits] ?? null;

        if ($formulaItem === null) {
            throw new LargeNumberException($this->number);
        }

        [$grabDigits, $suffix] = $formulaItem;

        $shortNumber = substr($inputNumber, 0, $grabDigits);

        return $shortNumber . $suffix;
    }
}
