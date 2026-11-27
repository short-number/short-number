<?php

declare(strict_types=1);

namespace Serhii\ShortNumber;

use Serhii\ShortNumber\Exceptions\LargeNumberException;

final class NumberShortener
{
    public const THOUSAND = 1000;
    private const MIN_DIGITS_TO_SHORTEN = 4;

    public function __construct(
        private readonly string $number,
        private readonly AbbreviationSet $set,
        private Config $config,
    ) {
    }

    /**
     * @throws LargeNumberException
     */
    public function shorten(): string
    {
        $digits = strlen($this->number);

        if ($digits < self::MIN_DIGITS_TO_SHORTEN) {
            return $this->number;
        }

        [$digitsToKeep, $suffix] = $this->set->formula[$digits]
            ?? throw new LargeNumberException($this->number);

        return sprintf(
            '%s%s%s',
            $this->truncateNumber($digitsToKeep),
            $this->config->suffixSeparator,
            $this->formatSuffix($suffix),
        );
    }

    private function truncateNumber(int $digitsToKeep): string
    {
        $result = substr($this->number, 0, $digitsToKeep);

        if ($this->config->decimals > 0) {
            $result .= sprintf(
                '%s%s',
                $this->config->decimalsSeparator,
                substr($this->number, $digitsToKeep, $this->config->decimals),
            );
        }

        return $result;
    }

    private function formatSuffix(string $suffix): string
    {
        foreach (Lang::getLangOverwrites() ?? [] as $search => $replacement) {
            $suffix = str_replace($search, $replacement, $suffix);
        }

        return $this->config->upperCase ? mb_strtoupper($suffix) : $suffix;
    }
}
