<?php

declare(strict_types=1);

namespace Serhii\ShortNumber;

final class AbbreviationSet
{
    /**
     * @param array<int,array{int,string}> $formula
     * @param array<string,string>|null $overwrites
     */
    public function __construct(
        public readonly array $formula,
        public readonly array|null $overwrites = null,
    ) {
    }
}
