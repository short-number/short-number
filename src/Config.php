<?php

declare(strict_types=1);

namespace Serhii\ShortNumber;

final class Config
{
    public readonly int $decimals;
    public readonly string $decimalsSeparator;
    public readonly string $suffixSeparator;
    public readonly bool $upperCase;

    public function __construct(
        int|null $decimals = null,
        string|null $decimalsSeparator = null,
        string|null $suffixSeparator = null,
        bool|null $upperCase = null,
    ) {
        $this->decimals = $decimals ?? 0;
        $this->decimalsSeparator = $decimalsSeparator ?? '.';
        $this->suffixSeparator = $suffixSeparator ?? '';
        $this->upperCase = $upperCase ?? false;
    }
}
