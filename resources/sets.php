<?php

declare(strict_types=1);

use Serhii\ShortNumber\AbbreviationSet;

return [
    'en' => new AbbreviationSet(
        thousand: 'k',
        million: 'm',
        billion: 'b',
        trillion: 't',
    ),
    'ru' => new AbbreviationSet(
        thousand: 'тыс',
        million: 'млн',
        billion: 'млд',
        trillion: 'трн',
    ),
    'uk' => new AbbreviationSet(
        thousand: 'тис',
        million: 'млн',
        billion: 'млд',
        trillion: 'трн',
    ),
    'zh' => new AbbreviationSet(
        thousand: ['千', '万', '万'],
        million: ['万', '万', '亿'],
        billion: ['亿', '亿', '亿'],
        trillion: ['兆', '兆', '兆'],
        rewrites: [
            '1千' => '千',
            '1万' => '万',
            '1亿' => '亿',
            '1兆' => '兆',
        ],
    ),
];
