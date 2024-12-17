<?php

declare(strict_types=1);

namespace Serhii\ShortNumber;

use Serhii\ShortNumber\Exceptions\LargeNumberException;

final class NumberShortener
{
    public const THOUSAND = 1000;

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

        $overwrites = Lang::getLangOverwrites();

        if (!empty($overwrites)) {
            $suffix = $this->overwritesSuffix($suffix, $overwrites);
        }

        $shortNumber = substr($inputNumber, 0, $grabDigits);

        return $shortNumber . $suffix;
    }

    /**
     * @param non-empty-array<string,string> $overwrites
     */
    private function overwritesSuffix(string $suffix, array $overwrites): string
    {
        foreach ($overwrites as $key => $value) {
            $suffix = str_replace($key, $value, $suffix);
        }

        return $suffix;
    }
}
