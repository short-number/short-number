<?php

/**
 * @see https://short-number.serhiicho.com/4.x/contribute.html#contribute-locale
 */

declare(strict_types=1);

use Serhii\ShortNumber\AbbreviationSet;
use Serhii\ShortNumber\FormulaRule;

return new AbbreviationSet(formula: [
    new FormulaRule(inputDigits: 4, integerDigits: 1, suffix: 'тыс'),
    new FormulaRule(inputDigits: 5, integerDigits: 2, suffix: 'тыс'),
    new FormulaRule(inputDigits: 6, integerDigits: 3, suffix: 'тыс'),
    new FormulaRule(inputDigits: 7, integerDigits: 1, suffix: 'млн'),
    new FormulaRule(inputDigits: 8, integerDigits: 2, suffix: 'млн'),
    new FormulaRule(inputDigits: 9, integerDigits: 3, suffix: 'млн'),
    new FormulaRule(inputDigits: 10, integerDigits: 1, suffix: 'млрд'),
    new FormulaRule(inputDigits: 11, integerDigits: 2, suffix: 'млрд'),
    new FormulaRule(inputDigits: 12, integerDigits: 3, suffix: 'млрд'),
    new FormulaRule(inputDigits: 13, integerDigits: 1, suffix: 'трлн'),
    new FormulaRule(inputDigits: 14, integerDigits: 2, suffix: 'трлн'),
    new FormulaRule(inputDigits: 15, integerDigits: 3, suffix: 'трлн'),
    new FormulaRule(inputDigits: 16, integerDigits: 1, suffix: 'квадр'),
    new FormulaRule(inputDigits: 17, integerDigits: 2, suffix: 'квадр'),
    new FormulaRule(inputDigits: 18, integerDigits: 3, suffix: 'квадр'),
]);
