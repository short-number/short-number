<?php

declare(strict_types=1);

namespace Serhii\ShortNumber;

final class Config
{
    /** Number of fractional digits to show when a fixed decimal count is configured. */
    public readonly int $decimals;

    /** Separator between integer and fractional parts. */
    public readonly string $decimalsSeparator;

    /** Separator between the number and its abbreviation suffix. */
    public readonly string $suffixSeparator;

    /** Whether to uppercase the formatted suffix text. */
    public readonly bool $upperCase;

    /** Whether the decimal count was explicitly provided. */
    public readonly bool $decimalsConfigured;

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
        $this->decimalsConfigured = $decimals !== null;
    }
}
