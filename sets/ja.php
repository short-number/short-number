<?php

/**
 * @see https://short-number.serhiicho.com/4.x/contribute.html#contribute-locale
 */

declare(strict_types=1);

use Serhii\ShortNumber\AbbreviationSet;
use Serhii\ShortNumber\FormulaRule;

return new AbbreviationSet(
    formula: [
        new FormulaRule(inputDigits: 5, integerDigits: 1, suffix: '万', significantDigits: 2),
        new FormulaRule(inputDigits: 6, integerDigits: 2, suffix: '万', significantDigits: 2),
        new FormulaRule(inputDigits: 7, integerDigits: 3, suffix: '万', significantDigits: 2),
        new FormulaRule(inputDigits: 8, integerDigits: 4, suffix: '万', significantDigits: 2),
        new FormulaRule(inputDigits: 9, integerDigits: 1, suffix: '億', significantDigits: 2),
        new FormulaRule(inputDigits: 10, integerDigits: 2, suffix: '億', significantDigits: 2),
        new FormulaRule(inputDigits: 11, integerDigits: 3, suffix: '億', significantDigits: 2),
        new FormulaRule(inputDigits: 12, integerDigits: 4, suffix: '億', significantDigits: 2),
        new FormulaRule(inputDigits: 13, integerDigits: 1, suffix: '兆', significantDigits: 2),
        new FormulaRule(inputDigits: 14, integerDigits: 2, suffix: '兆', significantDigits: 2),
        new FormulaRule(inputDigits: 15, integerDigits: 3, suffix: '兆', significantDigits: 2),
        new FormulaRule(inputDigits: 16, integerDigits: 4, suffix: '兆', significantDigits: 2),
        new FormulaRule(inputDigits: 17, integerDigits: 1, suffix: '京', significantDigits: 2),
        new FormulaRule(inputDigits: 18, integerDigits: 2, suffix: '京', significantDigits: 2),
    ],
);
