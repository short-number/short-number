<?php

declare(strict_types=1);

namespace Serhii\ShortNumber;

use Serhii\ShortNumber\Exceptions\LargeNumberException;

final class NumberShortener
{
    public function __construct(
        private readonly string $number,
        private readonly AbbreviationSet $set,
        private readonly Config $config,
    ) {
    }

    /**
     * @throws LargeNumberException
     */
    public function shorten(): string
    {
        $length = strlen($this->number);

        if ($this->isBelowShorteningThreshold($length)) {
            return $this->number;
        }

        $formula = $this->resolveFormula($length);

        return $this->compose(
            $formula->formatNumber($this->number, $this->config),
            $formula->suffix,
        );
    }

    private function isBelowShorteningThreshold(int $length): bool
    {
        $firstRule = $this->set->formula[0] ?? null;

        return $firstRule instanceof FormulaRule && $length < $firstRule->inputDigits;
    }

    /** @throws LargeNumberException */
    private function resolveFormula(int $length): FormulaRule
    {
        foreach ($this->set->formula as $rule) {
            if ($rule->inputDigits === $length) {
                return $rule;
            }
        }

        throw new LargeNumberException($this->number);
    }

    private function compose(string $coefficient, string $suffix): string
    {
        return $coefficient . $this->config->suffixSeparator . $this->localize($suffix);
    }

    private function localize(string $text): string
    {
        foreach (Lang::getLangOverwrites() ?? [] as $search => $replacement) {
            $text = str_replace($search, $replacement, $text);
        }

        return $this->config->upperCase ? mb_strtoupper($text) : $text;
    }
}
