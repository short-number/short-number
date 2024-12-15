<?php

declare(strict_types=1);

use Serhii\ShortNumber\AbbreviationSet;

return new AbbreviationSet(
    thousand: ['千', '万', '万'],
    million: ['万', '万', '亿'],
    billion: ['亿', '亿', '亿'],
    trillion: ['兆', '兆', '兆'],
    quadrillion: ['京', '京', '京'],
    rewrites: [
        '1千' => '千',
        '1万' => '万',
        '1亿' => '亿',
        '1兆' => '兆',
    ],
);
