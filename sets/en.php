<?php

/**
 * @see https://short-number.serhiicho.com/4.x/contribute.html#contribute-locale
 */

declare(strict_types=1);

use Serhii\ShortNumber\AbbreviationSet;
use Serhii\ShortNumber\FormulaRule;

return new AbbreviationSet(formula: [
    new FormulaRule(inputDigits: 4, integerDigits: 1, suffix: 'k'),
    new FormulaRule(inputDigits: 5, integerDigits: 2, suffix: 'k'),
    new FormulaRule(inputDigits: 6, integerDigits: 3, suffix: 'k'),
    new FormulaRule(inputDigits: 7, integerDigits: 1, suffix: 'm'),
    new FormulaRule(inputDigits: 8, integerDigits: 2, suffix: 'm'),
    new FormulaRule(inputDigits: 9, integerDigits: 3, suffix: 'm'),
    new FormulaRule(inputDigits: 10, integerDigits: 1, suffix: 'b'),
    new FormulaRule(inputDigits: 11, integerDigits: 2, suffix: 'b'),
    new FormulaRule(inputDigits: 12, integerDigits: 3, suffix: 'b'),
    new FormulaRule(inputDigits: 13, integerDigits: 1, suffix: 't'),
    new FormulaRule(inputDigits: 14, integerDigits: 2, suffix: 't'),
    new FormulaRule(inputDigits: 15, integerDigits: 3, suffix: 't'),
    new FormulaRule(inputDigits: 16, integerDigits: 1, suffix: 'q'),
    new FormulaRule(inputDigits: 17, integerDigits: 2, suffix: 'q'),
    new FormulaRule(inputDigits: 18, integerDigits: 3, suffix: 'q'),
]);
