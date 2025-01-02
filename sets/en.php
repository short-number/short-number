<?php

/**
 * @see https://short-number.github.io/4.x/contribute.html#contribute-locale
 */

declare(strict_types=1);

use Serhii\ShortNumber\AbbreviationSet;

return new AbbreviationSet(formula: [
    4 => [1, 'k'], 5 => [2, 'k'], 6 => [3, 'k'],
    7 => [1, 'm'], 8 => [2, 'm'], 9 => [3, 'm'],
    10 => [1, 'b'], 11 => [2, 'b'], 12 => [3, 'b'],
    13 => [1, 't'], 14 => [2, 't'], 15 => [3, 't'],
    16 => [1, 'q'], 17 => [2, 'q'], 18 => [3, 'q'],
]);
