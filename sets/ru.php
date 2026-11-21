<?php

/**
 * @see https://short-number.serhiicho.com/4.x/contribute.html#contribute-locale
 */

declare(strict_types=1);

use Serhii\ShortNumber\AbbreviationSet;

return new AbbreviationSet(formula: [
    4 => [1, 'тыс'], 5 => [2, 'тыс'], 6 => [3, 'тыс'],
    7 => [1, 'млн'], 8 => [2, 'млн'], 9 => [3, 'млн'],
    10 => [1, 'млрд'], 11 => [2, 'млрд'], 12 => [3, 'млрд'],
    13 => [1, 'трлн'], 14 => [2, 'трлн'], 15 => [3, 'трлн'],
    16 => [1, 'квадр'], 17 => [2, 'квадр'], 18 => [3, 'квадр'],
]);
