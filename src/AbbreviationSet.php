<?php

declare(strict_types=1);

namespace Serhii\ShortNumber;

final class AbbreviationSet
{
    /**
     * @param string|string[]|null $thousand
     * @param string|string[]|null $million
     * @param string|string[]|null $billion
     * @param string|string[]|null $trillion
     * @param array<string,string>|null $rewrites
     */
    public function __construct(
        public readonly string|array|null $thousand = null,
        public readonly string|array|null $million = null,
        public readonly string|array|null $billion = null,
        public readonly string|array|null $trillion = null,
        public readonly array|null $rewrites = null,
    ) {
    }
}
