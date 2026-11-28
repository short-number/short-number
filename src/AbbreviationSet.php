<?php

declare(strict_types=1);

namespace Serhii\ShortNumber;

final class AbbreviationSet
{
    /**
     * @param list<FormulaRule> $formula
     */
    public function __construct(public readonly array $formula)
    {
    }
}
