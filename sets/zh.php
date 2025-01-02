<?php

declare(strict_types=1);

use Serhii\ShortNumber\AbbreviationSet;

/**
 * @see https://short-number.github.io/4.x/contribute.html#contribute-locale
 */
return new AbbreviationSet(
    formula: [
        4 => [1, '千'], 5 => [1, '万'], 6 => [2, '万'],
        7 => [3, '万'], 8 => [4, '万'], 9 => [1, '亿'],
        10 => [2, '亿'], 11 => [3, '亿'], 12 => [4, '亿'],
        13 => [1, '兆'], 14 => [2, '兆'], 15 => [3, '兆'],
        16 => [4, '兆'], 17 => [1, '京'], 18 => [2, '京'],
    ],
    overwrites: [
        '1千' => '千',
        '1万' => '万',
        '1亿' => '亿',
        '1兆' => '兆',
        '1京' => '京',
        '-1千' => '-千',
        '-1万' => '-万',
        '-1亿' => '-亿',
        '-1兆' => '-兆',
        '-1京' => '-京',
    ],
);
